<?php

namespace App\Http\Controllers;

use App\Models\ObjekPajak;
use App\Models\Pembayaran;
use App\Models\Tunggakan;
use App\Models\WajibPajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PrintController extends Controller
{

    public function printwp()
    {
        $wajibPajak = WajibPajak::with(['objekpajak'])->orderBy('id')->get();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('wajib-pajak.print', ['wajibPajak' => $wajibPajak]);
        $pdf->setPaper('a4', 'landscape')->setWarnings(false);

        return $pdf->stream();

//        return view('wajib-pajak.print',compact('wajibPajak'));
    }

    public function printop()
    {
        $objekPajak = ObjekPajak::with(['wajibpajak', 'pembayaran', 'jenisObjekPajak'])->orderBy('id')->get();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('objek-pajak.print', ['objekPajak' => $objekPajak]);
        $pdf->setPaper('a4', 'landscape')->setWarnings(false);

        return $pdf->stream();
    }

    // Cetak Pembayaran
    public function cetakPembayaran(Request $request)
    {
        $request = $request->has('opid') ? (int) $request->get('opid') : 1;
        $title = $this->getTitle($request);
        $pembayaran = Pembayaran::with(['wajibpajak', 'objekpajak'])
            ->where('objek_pajak_id',$request)
            ->orderBy('id')
            ->get();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('transaksi-pajak.pembayaran.cetak-pembayaran', ['pembayaran' => $pembayaran,'opid' => $request,'title' => $title]);
        $pdf->setPaper('a4', 'landscape')->setWarnings(false);

        return $pdf->stream();
    }

    public function printtunggakan()
    {
        $tunggakan = Tunggakan::with(['pembayaran'])
            ->whereYear('created_at', setting('tahun_sppt'))
            ->get();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('transaksi-pajak.tunggakan.print', ['tunggakan' => $tunggakan]);
        $pdf->setPaper('a4', 'landscape')->setWarnings(false);

        return $pdf->stream();
//        return view('transaksi-pajak.tunggakan.print');
    }

    /**
     * @param  int  $request
     *
     * @return string
     */
    private function getTitle(int $request): string
    {
        if ($request === 1) {
            $title = 'Rumah Makan';
        } elseif ($request === 2) {
            $title = 'Hotel';
        } elseif ($request === 3) {
            $title = 'Reklame';
        } elseif ($request === 4) {
            $title = 'Tambang Mineral';
        } else {
            $title = 'Pajak Penerangan Jalan';
        }

        return $title;
}
}
