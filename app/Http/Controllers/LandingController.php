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
        $totalWajibPajak = Customers::all()->count();
        $totalObjekPajak = Customers::where(['is_valid' => 1, 'status_pelanggan' => 1])->count();
        $totalTargetPajak = Payment::where('status_pembayaran', 1)->sum('total_tagihan');
        $totalRealisasiPajak = Payment::where('status_pembayaran', 2)->sum('total_bayar');

        $data = [
            'totalWajibPajak' => $totalWajibPajak,
            'totalObjekPajak' => $totalObjekPajak,
            'totalTargetPajak' => $totalTargetPajak,
            'totalRealisasiPajak' => $totalRealisasiPajak
        ];

        return view('landing.index', compact('data'));
    }

    public function searchTracking(Request $request): RedirectResponse
    {
        $search = $request->has('search') ? $request->get('search') : null;
        return redirect()->route('tracking', ['q' => $search]);
    }
}
