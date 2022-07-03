<?php

namespace App\Http\Livewire;

use App\Models\ObjekPajak;
use App\Models\Pembayaran;
use App\Models\WajibPajak;
use App\Utilities\Helper;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\BaseChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Livewire\Component;

class Dashboard extends Component
{
    public int $totalWajibPajak = 0;
    public int $totalObjekPajak = 0;
    public int $totalTargetPajak = 0;
    public int $totalRealisasiPajak = 0;

    public int $maxValue = 100;
    public int $minValue = 10;
    public array $data = [];
    public array $series = [];
    public array $label = [];

    public $objekPajak;
    public $terbesar;
    public $tercepat;
    public array $listBulan = [];
    protected $listPembayaran;
    public array $pembayaran = [];
    public array $target = [];
    public array $realisasi = [];

    public array $totalPajak = [];

    public $tahun;
    public $columnChart;
    public $pieChart;

    public $types = ['food', 'shopping', 'entertainment', 'travel', 'other'];
    public $firstRun = true;
    public $showDataLabels = false;
    public $colors
        = [
            'RMN' => '#2ab57d',
            'HTL' => '#5156be',
            'RKM' => '#fd625e',
            'TBM' => '#4ba6ef',
            'PPJ' => '#ffbf53',
        ];

    protected $listeners
        = [
            'onPointClick'  => 'handleOnPointClick',
            'onSliceClick'  => 'handleOnSliceClick',
            'onColumnClick' => 'handleOnColumnClick',
        ];

    public function handleOnPointClick($point)
    {
        dd($point);
    }

    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }

    public function handleOnColumnClick($column)
    {
        dd($column);
    }

    private function renderDashboard()
    {
        $this->totalWajibPajak = WajibPajak::count();
        $this->totalObjekPajak = ObjekPajak::count();
        $this->totalTargetPajak = Pembayaran::when($this->tahun, function ($q) {
            $q->where('tahun', $this->tahun);
        })->sum('nilai_pajak');
        $this->totalRealisasiPajak = Pembayaran::when($this->tahun, function ($q) {
            $q->where('tahun', $this->tahun);
        })->where('status_bayar', 1)->sum('nilai_pajak');

        $objekPajak = ObjekPajak::with(['wajibpajak', 'pembayaran', 'jenisObjekPajak'])
            ->when($this->tahun, function ($q) {
                $q->whereHas('pembayaran', function ($q) {
                    $q->where('tahun', $this->tahun);
                });
            })
            ->groupBy('id_jenis_op');

        $this->objekPajak = $objekPajak->get();
        $this->listBulan = Helper::list_bulan(true);

        foreach ($this->objekPajak as $item) {
            $this->listPembayaran = $item->pembayaran();
        }

        $op = Pembayaran::with(['wajibpajak', 'objekpajak', 'objekpajak.jenisObjekPajak'])
            ->when($this->tahun, function ($q) {
                $q->where('tahun', $this->tahun);
            })
            ->where('status_bayar', 1);
        $this->terbesar = $op
            ->orderByDesc('nilai_pajak')
            ->take(10)->get();

        $this->tercepat = $op
            ->orderByDesc('created_at')
            ->take(10)->get();

    }

    public function mount()
    {
        $this->tahun = setting('tahun_sppt', now()->year);
        $this->firstRun = true;
        $this->renderDashboard();
    }

    public function updatedTahun()
    {
        $this->firstRun = true;
        $this->renderDashboard();
    }

    private function _renderChartColumn(): ColumnChartModel
    {
        $columChartModel = LivewireCharts::multiColumnChartModel();
        foreach ($this->listBulan as $key => $item) {
            $query = Pembayaran::with(['wajibpajak', 'objekpajak'])
                ->when($this->tahun, function ($q) {
                    $q->where('tahun', $this->tahun);
                })
                ->where('bulan', $key);

            $nilaiPajakTarget = $query->get()->sum('nilai_pajak');
            $dendaTarget = $query->get()->sum('denda');

            $nilaiPajakRealisasi = $query
                ->where('status_bayar', 1)
                ->get()->sum('nilai_pajak');
            $dendaRealisasi = $query
                ->where('status_bayar', 1)
                ->get()->sum('denda');

            $this->target[] = $nilaiPajakTarget - $dendaTarget;
            $this->realisasi[] = $nilaiPajakRealisasi - $dendaRealisasi;

            $target = $nilaiPajakTarget - $dendaTarget;
            $realisasi = $nilaiPajakRealisasi - $dendaRealisasi;

            $columChartModel->addSeriesColumn('target', $item, $target);
            $columChartModel->addSeriesColumn('realisasi', $item, $realisasi);
        }

        return $columChartModel->setTitle('Dalam juta - milyar')
            ->setAnimated($this->firstRun)
            ->setXAxisCategories(array_values($this->listBulan))
//            ->withOnColumnClickEventName('onColumnClick')
            ->setLegendVisibility(true)
            ->setDataLabelsEnabled($this->showDataLabels)
            ->setColumnWidth(40)
            ->multiColumn();
    }

    private function setColors($label): string
    {
        if ($label === 'Rumah Makan') {
            $color = $this->colors['RMN'];
        } elseif ($label === 'Hotel') {
            $color = $this->colors['HTL'];
        } elseif ($label === 'Reklame') {
            $color = $this->colors['RKM'];
        } elseif ($label === 'Tambang Mineral') {
            $color = $this->colors['TBM'];
        } else {
            $color = $this->colors['PPJ'];
        }
        return $color;
    }

    private function _renderChartPie(): BaseChartModel
    {

        $pieChartModel = LivewireCharts::pieChartModel();
        foreach ($this->objekPajak as $item) {
            $target = $item->pembayaran()->sum('nilai_pajak');
            $targetDenda = $item->pembayaran()->sum('denda');
            $realisasi = $item->pembayaran()->where('status_bayar', 1)->sum('nilai_pajak');
            $realisasiDenda = $item->pembayaran()->where('status_bayar', 1)->sum('denda');

            $nilaiTarget = $target - $targetDenda;
            $nilaiRealisasi = $realisasi - $realisasiDenda;
            $this->data = [
                ['name' => 'target', 'data' => [(double) $nilaiTarget]],
                ['name' => 'realisasi', 'data' => [(double) $nilaiRealisasi]],
            ];

            $this->series[] = (double) $nilaiRealisasi;
            $this->label[] = $item->jenisObjekPajak->nama_jenis_op;

            $series = (double) $nilaiRealisasi;
            $label = $item->jenisObjekPajak->nama_jenis_op;

            $color = $this->setColors($label);
            $pieChartModel->addSlice($label, $series, $color);
        }

        return $pieChartModel->setAnimated($this->firstRun)
            ->legendPositionBottom()
            ->legendHorizontallyAlignedCenter()
            ->setDataLabelsEnabled($this->showDataLabels);
    }

    public function render()
    {
        $listObjekPajak = ObjekPajak::with(['wajibpajak', 'pembayaran', 'jenisObjekPajak.targetPajak'])
            ->withSum('pembayaran', 'nilai_pajak')
            ->when($this->tahun, function ($q) {
                $q->whereHas('pembayaran', function ($q) {
                    $q->where('tahun', $this->tahun);
                });
            })
            ->orderBy('created_at', 'DESC')
            ->get();

        $columnChartModel = $this->_renderChartColumn();
        $pieChartModel = $this->_renderChartPie();

        $listTahun = config('custom.tahun_kontrak');

        $this->firstRun = false;

        return view('livewire.dashboard', compact('listObjekPajak', 'columnChartModel', 'pieChartModel', 'listTahun'));
//        return view('livewire.dashboard', compact('listObjekPajak'));
    }
}
