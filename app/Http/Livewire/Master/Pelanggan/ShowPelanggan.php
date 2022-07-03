<?php

namespace App\Http\Livewire\Master\Pelanggan;

use App\Models\Customers;
use App\Models\Payment;
use App\Models\PaymentHistory;
use App\Models\Pembayaran;
use App\Utilities\Helpers;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class ShowPelanggan extends Component
{
    public Customers $customer;
    public Activity $activity;
    public Payment $pembayaran;
    use WithPagination;
    protected string $paginationTheme = 'bootstrap';
    public array $pageData = [];
    public int $perPage = 15;

    public function mount(string $id, Activity $activity, Payment $pembayaran)
    {
        $id = Helpers::decodeId($id);
        $customer = Customers::find($id);
        $this->customer = $customer;
        $this->activity = $activity;
        $this->pembayaran = $pembayaran;
    }

    public function render()
    {
        $listActivity = $this->activity->where('causer_id', auth()->user()->id)->latest()->take(5)->get();
        $listHistory = PaymentHistory::with(['pengguna','customer','payment'])->where('customer_id', $this->customer->id)->latest()->take(5)->get();
        $listPembayaran = $this->pembayaran->with('history')->where('customer_id', $this->customer->id)->latest()->paginate($this->perPage);
        $this->pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listPembayaran->sum('total'),
        ];
        return view('livewire.master.pelanggan.show-pelanggan',compact('listActivity','listPembayaran','listHistory'))
            ->extends('layouts.contentLayoutMaster');
    }
}
