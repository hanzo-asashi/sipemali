<?php

namespace App\Http\Livewire;

use App\Models\Customers;
use App\Models\Payment;
use App\Utilities\Helpers;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Dashboard extends Component
{
    public $types = [1, 2, 3];

    public $colors = [
        1 => '#f6ad55',
        2 => '#fc8181',
        3 => '#90cdf4',
        4 => '#66DA26',
        5 => '#cbd5e0',
        6 => '#4fa00d',
        7 => '#f48648',
        8 => '#00335d',
        9 => '#21b6eb',
        10 => '#931d8f',
        11 => '#c61848',
        12 => '#b0d261',
    ];

    public $firstRun = true;

    public $showDataLabels = false;

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
        'onBlockClick' => 'handleOnBlockClick',
    ];

    public $filterTahun = 'all';

    public $tahun;

    public $updatedTime = 0;
    public int $chartView = 0;

    public array $statistik = [];

    public $breadcrumbs = [
        ['name' => 'Home'],
    ];

    public string $title = 'Dashboard';

    public function handleOnPointClick($point)
    {
        //dd($point);
    }

    public function handleOnSliceClick($slice): void
    {
        //dd($slice);
    }

    public function handleOnColumnClick($column): void
    {
        //dd($column);
    }

    public function handleOnBlockClick($block): void
    {
        //dd($block);
    }

    public function mount(): void
    {
        $this->calculateStatistik();
        $this->updatedTime = today()->diffForHumans();
//        dd($this->title);
    }

    public function setChartFilter(int $value)
    {
        $this->chartView = $value;
    }


    private function calculateStatistik(): void
    {
        $this->statistik['utang'] = Cache::remember('total_tagihan_utang', 3600, function () {
            return Payment::query()
                ->when($this->chartView, fn ($query) => $query->where('created_at', '>=', today()->subDays($this->chartView)))
                ->statusPembayaran(3)->sum('total_tagihan');
        });

        $this->statistik['piutang'] = Cache::remember('total_tagihan_piutang', 3600, function () {
            return Payment::query()
                ->when($this->chartView, fn ($query) => $query->where('created_at', '>=', today()->subDays($this->chartView)))
                ->statusPembayaran(2)->sum('total_tagihan');
        });

        $this->statistik['pendapatan'] = Cache::remember('total_tagihan_pendapatan', 3600, function () {
            return Payment::query()
                ->when($this->chartView, fn ($query) => $query->where('created_at', '>=', today()->subDays($this->chartView)))
                ->statusPembayaran(1)->sum('total_tagihan');
        });

        $this->statistik['pelanggan'] = Cache::remember('total_pelanggan', 3600, function () {
            return Customers::get()->count();
        });

//        $this->statistik['utang'] = Payment::query()->statusPembayaran(3)->sum('total_tagihan');
//        $this->statistik['piutang'] = Payment::query()->statusPembayaran(2)->sum('total_tagihan');
//        $this->statistik['pendapatan'] = Payment::query()->statusPembayaran(1)->sum('total_tagihan');
//        $this->statistik['pelanggan'] = Customers::get()->count();
    }

    public function render(): Factory|View|Application
    {
        $columnChartModel = LivewireCharts::columnChartModel();
        $listBulan = Helpers::list_bulan(true);
        $pembayaran = Payment::select('customer_id', 'bulan_berjalan', 'total_tagihan')->get();

//        $pembayaranByCustomerPerMonth = $pembayaran->groupBy('customer_id')->reduce(function (&$carry, $item, $key) use ($listBulan) {
//            foreach ($listBulan as $k => $bulan) {
//                $carry[$key][$bulan] = $item->where('bulan_berjalan', $k)->sum('total_tagihan');
//            }
//
//            return $carry;
//        }, []);

//        dd($pembayaranByCustomerPerMonth);

        foreach ($listBulan as $key => $item) {
            $bayar = $pembayaran->where('bulan_berjalan', $key)
//                ->when($this->chartView, fn ($query) => $query->whereBetween('created_at', '<=', today()->subDays($this->chartView)))
                ->sum('total_tagihan');
            $bayar = number_format($bayar, 0, ',', '.');
            $columnChartModel->addColumn($item, $bayar, $this->colors[$key]);
        }

//        $pembayaranByCustomer = $pembayaran->reduce(function (&$carry, $item, $key) use ($listBulan, $pembayaran, $columnChartModel) {
//            foreach ($listBulan as $k => $bln) {
//                $bayar = $pembayaran->where('bulan_berjalan', $k)->sum('total_tagihan');
//                $carry[$k][$bln] = $bayar;
////                $columnChartModel->addColumn($bln, $bayar, $this->colors[$key]);
//            }
//
//            return $carry;
//        }, []);
//
//        dd($pembayaranByCustomer);

//        $pembayaranByBulan = $pembayaran->groupBy('bulan_berjalan')->map(function ($item, $key) use ($listBulan, $columnChartModel) {
//            $columnChartModel->addColumn($listBulan[$key], $item->sum('total_tagihan'), $this->colors[$key]);
//            return [
//                'bulan' => $listBulan[$key],
//                'total_tagihan' => $item->sum('total_tagihan'),
//            ];
//        });
//        dd($pembayaranByBulan);

        $columnChartModel->setTitle('Total Tagihan Per Bulan')
            ->setAnimated($this->firstRun)
            ->withOnColumnClickEventName('onColumnClick')
            ->setLegendVisibility(true)
            ->setDataLabelsEnabled($this->showDataLabels)
//            ->setOpacity(0.25)
            ->setColumnWidth(70)
            ->withDataLabels();

        return view('livewire.dashboard', compact('columnChartModel'));
    }
}
