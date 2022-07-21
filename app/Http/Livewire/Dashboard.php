<?php

namespace App\Http\Livewire;

use App\Models\Customers;
use App\Models\Payment;
use App\Utilities\Helpers;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
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
//        dd($this->title);
    }

    private function calculateStatistik(): void
    {
        $this->statistik['utang'] = Payment::where('status_pembayaran', '=', 3)->sum('total_tagihan');
        $this->statistik['piutang'] = Payment::where('status_pembayaran', '=', 2)->sum('total_tagihan');
        $this->statistik['pendapatan'] = Payment::where('status_pembayaran', '=', 1)->sum('total_tagihan');
        $this->statistik['pelanggan'] = Customers::all()->count();
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $columnChartModel = LivewireCharts::columnChartModel();
        $listBulan = Helpers::list_bulan(true);
        $pembayaran = Payment::all();

        $pembayaranByCustomerPerMonth = $pembayaran->groupBy('customer_id')->reduce(function (&$carry, $item, $key) use ($listBulan) {
            foreach ($listBulan as $k => $bulan) {
                $carry[$key][$bulan] = $item->where('bulan_berjalan', $k)->sum('total_tagihan');
            }

            return $carry;
        }, []);

        foreach ($listBulan as $key => $item) {
            $bayar = Payment::query()->where('bulan_berjalan', $key)->sum('total_tagihan');
            $bayar = number_format($bayar, 0, ',', '.');
            $columnChartModel->addColumn($item, $bayar, $this->colors[$key]);
        }

        $pembayaranByCustomer = $pembayaran->groupBy('customer_id')->reduce(function (&$carry, $item, $key) {
            $carry[$key] = $item->sum('total_tagihan');

            return $carry;
        }, []);

//        $pembayaranByBulan = $pembayaran->groupBy('bulan_berjalan')->map(function ($item, $key) use ($listBulan, $columnChartModel) {
//            $columnChartModel->addColumn($listBulan[$key], $item->sum('total_tagihan'), $this->colors[$key]);
//            return [
//                'bulan' => $listBulan[$key],
//                'total_tagihan' => $item->sum('total_tagihan'),
//            ];
//        });

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
