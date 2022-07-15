<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $totalSemuaPelanggan = Customers::all()->count();
        $totalPelangganAktif = Customers::where('status_pelanggan', 1)->count();
        $totalPelangganValid = Customers::where(['is_valid' => 1, 'status_pelanggan' => 1])->count();
        $totalPendapatan = Payment::where('status_pembayaran', 1)->sum('total_tagihan');
        $totalTertunggak = Payment::where('status_pembayaran', 2)->sum('total_bayar');

        $data = [
            'totalSemuaPelanggan' => $totalSemuaPelanggan,
            'totalPelangganAktif' => $totalPelangganAktif,
            'totalPelangganValid' => $totalPelangganValid,
            'totalPendapatan' => $totalPendapatan,
            'totalTertunggak' => $totalTertunggak
        ];

        return view('landing.index', compact('data'));
    }

    public function searchTracking(Request $request): RedirectResponse
    {
        $search = $request->has('search') ? $request->get('search') : null;
        return redirect()->route('tracking', ['q' => $search]);
    }
}
