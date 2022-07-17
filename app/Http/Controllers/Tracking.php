<?php

namespace App\Http\Controllers;

use App\Models\PembayaranPajak;
use App\Models\Tunggakan;
use App\Models\WajibPajak;
use Illuminate\Http\Request;

class Tracking extends Controller
{
    public function index(Request $request)
    {
        $search = $request->has('q') ? $request->get('q') : null;
        $wajibPajak = WajibPajak::with(['objekpajak', 'pembayaran', 'jenisWajibPajak', 'objekpajak.jenisObjekPajak'])
            ->search($search)
            ->get()->first();

        $detailWajibPajak = collect();
        $pembayaran = collect();
        $tunggakan = collect();

        if (! is_null($wajibPajak)) {
            $detailWajibPajak = WajibPajak::with([
                'objekpajak', 'objekpajakrumahmakan', 'jenisWajibPajak', 'kab', 'kec', 'kel', 'objekpajak.pembayaran', 'pembayaran',
            ])
                ->find($wajibPajak->id);
//            $pembayaran = PembayaranPajak::with(['objekpajak.objekPajakRumahMakan','wajibpajak','tunggakan'])->where('wajib_pajak_id', $wajibPajak->id)->get();
            foreach ($detailWajibPajak->pembayaran()->with(['objekpajak', 'tunggakan'])->get() as $item) {
                $pembayaran->add($item);
            }

            foreach ($pembayaran as $item) {
                $tunggakan->add(Tunggakan::with(['pembayaran'])->where('pembayaran_id', $item->id)->get());
            }
        }

        return view('landing.tracking', compact('wajibPajak', 'detailWajibPajak', 'pembayaran', 'tunggakan'));
    }
}
