<?php

namespace App\Http\Controllers;

use App\Models\ObjekPajak;
use App\Models\PembayaranPajak;
use App\Models\WajibPajak;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $totalWajibPajak = WajibPajak::count();
        $totalObjekPajak = ObjekPajak::count();
//        $totalTargetPajak = TargetPajak::sum('target');
        $totalTargetPajak = PembayaranPajak::sum('nilai_pajak');
        $totalRealisasiPajak = PembayaranPajak::where('status_bayar',1)->sum('nilai_pajak');

        $data = [
            'totalWajibPajak' => $totalWajibPajak,
            'totalObjekPajak' => $totalObjekPajak,
            'totalTargetPajak' => $totalTargetPajak,
            'totalRealisasiPajak' => $totalRealisasiPajak
        ];

        return view('landing.index', compact('data'));
    }

    public function searchTracking(Request $request)
    {
        $search = $request->has('search') ? $request->get('search') : null;
        return redirect()->route('tracking', ['q' => $search]);
    }
}
