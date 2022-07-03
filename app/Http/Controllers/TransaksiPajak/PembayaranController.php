<?php

namespace App\Http\Controllers\TransaksiPajak;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('transaksi-pajak.pembayaran.index');
    }
    public function show(Pembayaran $pembayaran)
    {
        return view('transaksi-pajak.pembayaran.detail', compact('pembayaran'));
    }
    public function create()
    {
        return view('transaksi-pajak.pembayaran.create');
    }
}
