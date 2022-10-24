<?php

namespace App\Http\Livewire\Master\Pelanggan;

use App\Models\Customers;
use App\Models\Payment;
use App\Models\PaymentHistory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class ShowPelanggan extends Component
{
    use WithPagination, AuthorizesRequests;

    public Customers $customer;

    protected string $paginationTheme = 'bootstrap';

    public array $pageData = [];

    public int $perPage = 15;

    public function mount(string $id): void
    {
        if (!auth()->user()?->can('show pelanggan')) {
            abort(403);
        }

        $this->customer = Customers::findOrFailByHashId($id);
    }

    public function render(): Factory|View|Application
    {
        $listActivity = Activity::where('causer_id', auth()->user()->id)->latest()->take(5)->get();
        $listHistory = PaymentHistory::with(['pengguna', 'customer', 'payment'])->where('customer_id', $this->customer->id)->latest()->take(5)->get();
        $listPembayaran = Payment::with('history')->where('customer_id', $this->customer->id)->latest()->fastPaginate($this->perPage);
        $this->pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listPembayaran->sum('total'),
        ];

        return view('livewire.master.pelanggan.show-pelanggan', compact('listActivity', 'listPembayaran', 'listHistory'));
    }
}
