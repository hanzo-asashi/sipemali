<?php

namespace App\Http\Controllers;

use App\Models\WajibPajak;

class QrviewController extends Controller
{
    public function __invoke($wpid)
    {
        $wajibPajak = WajibPajak::with(['objekpajak','pembayaran'])->find($wpid);
        return view('qrcode-view.index', compact('wajibPajak'));
    }

}
