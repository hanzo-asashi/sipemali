<?php

namespace App\Http\Livewire;

use App\Models\Customers;
use Livewire\Component;

class Select2Dropdown extends Component
{
    public string $ottPlatform = '';

    public array $webseries = [
        'Wanda Vision',
        'Money Heist',
        'Lucifer',
        'Stranger Things'
    ];

    public string $model = '';
    public $customers;
    public string $selected = '';

    public function mount(Customers $customers)
    {
//        $this->customers = $customers ;
        $this->customers = $customers->pluck('nama_pelanggan', 'id');
//        dd($this->customers);
    }

    public function render()
    {
        $listPelanggan = Customers::pluck('nama_pelanggan', 'id');
        return view('livewire.select2-dropdown')->extends('layouts.contentLayoutMaster', compact('listPelanggan'));
    }
}
