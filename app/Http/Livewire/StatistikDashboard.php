<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class StatistikDashboard extends Component
{
    public string $updatedDate;

    public array $tipe = [];

    public $listeners = ['updatedData'];

    public function mount()
    {
        $this->updatedDate = Carbon::now()->diffForHumans();
        $this->tipe = [
            'sales'     => ['name' => 'Sales', 'count' => '250k', 'bg' => 'primary', 'icon' => 'trending-up'],
            'customers' => ['name' => 'Customers', 'count' => '8.549k', 'bg' => 'info', 'icon' => 'user'],
            'products'  => ['name' => 'Products', 'count' => '1.423k', 'bg' => 'danger', 'icon' => 'box'],
            'revenue'   => ['name' => 'Revenue', 'count' => '$9754', 'bg' => 'success', 'icon' => 'dollar-sign'],
        ];
    }

    public function render()
    {
        return view('livewire.statistik-dashboard');
    }

    public function updatedData($date)
    {
        $date = \Illuminate\Support\Carbon::parse($date)->diffForHumans();
        $this->updatedDate = $date;
//    $this->emit('updatedData');
    }
}
