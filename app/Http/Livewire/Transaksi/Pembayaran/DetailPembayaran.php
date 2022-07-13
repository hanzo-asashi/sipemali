<?php

namespace App\Http\Livewire\Transaksi\Pembayaran;

use App\Models\Customers;
use App\Models\Payment;
use App\Utilities\Helpers;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class DetailPembayaran extends Component
{
    public string $title = 'Detail Pembayaran';
    public $payment;
    public Customers $customer;

    use WithPagination;
    protected string $paginationTheme = 'bootstrap';
    public $pageData = [];
    public int $perPage;

    public function mount(string $id): void
    {
        $id = Helpers::decodeId($id);
        $this->perPage = config('custom.page_count', 15);
        $this->customer = Customers::with(['payment', 'payment.history', 'paymentHistory'])->find($id);
        $this->payment = Payment::with(['customer', 'history'])->find($id);
    }

    public function render(): Factory|View|Application
    {
        $listPembayaran = $this->customer->payment()->latest();
        $totalData = $listPembayaran->count();
        $listPembayaran = $listPembayaran->paginate($this->perPage);
        $listHistory = $this->customer->paymentHistory()->latest()->take(5)->get();
        $this->pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $totalData,
        ];
//        dd($this->pageData, $listPembayaran);
        return view('livewire.transaksi.pembayaran.detail-pembayaran', compact('listPembayaran', 'listHistory'));
    }
}
