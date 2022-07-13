<?php

namespace App\Http\Controllers;

use App;
use App\Models\Customers;
use App\Models\Payment;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public array $availablePage = ['ikhtisar-lpp', 'penerimaan-penagihan', 'opname-fisik', 'rekening-air', 'pembayaran', 'pelanggan'];

    public function transaksi(Request $request)
    {
        $pageData = [];
        $data = $request->all();
        $id = $data['id'];
        $pembayaranId = $data['pembayaran_id'];
        $page = $data['page'] ?? '';

        if ($page === 'pembayaran') {
            $view = 'laporan.transaksi';
        } else {
            $view = 'laporan.partials.print-transaksi';
            $pelanggan = Customers::with(['payment', 'golonganTarif', 'statusPelanggan', 'zona', 'metodeBayar'])->find($id);
            $pembayaran = $pelanggan->payment()->with('metodeBayar')->latest()->find($pembayaranId);
            $pageData['pelanggan'] = $pelanggan;
            $pageData['pembayaran'] = $pembayaran;
            $pageData['id'] = $data['id'] ?? 1;
            $pageData['pembayaran_id'] = $pembayaranId;
        }

        $pageData['page'] = $page;


        return view($view, compact($pageData));
    }

    public function preview(Request $request)
    {
        $pageData = [];
        $data = $request->all();
        $page = $data['page'] ?? '';
        $pageData['page'] = $page;
        $range = $data['range'] ?? '';
        $start = $data['start'] ?? '';
        $end = $data['end'] ?? '';
        $filterZona = $data['filterZona'] ?? '';
        $pageArray = ['transaksi', 'ikhtisar-lpp', 'penerimaan-penagihan', 'rekening-air', 'pembayaran', 'opname-fisik','catat-meter'];
        $tipe = '';
        $view = 'laporan.preview.'.$page;
        if (in_array($page, $pageArray, true)) {
            if ($page === 'pembayaran') {
                $payment = Payment::query();
                if ($data['data'] = 'all') {
                    $payment = $payment->get();
                } else {
                    $payment = $payment->whereIn('id', $data['data']);
                }
                $pageData['payment'] = $payment;
                $view = 'laporan.transaksi';
                $tipe = 'stream';
            }

            if ($page === 'opname-fisik') {
                $tipe = 'stream';
                $customer = Customers::query()
                    ->with(['payment', 'golonganTarif', 'zona'])
                    ->withSum('payment', 'total_tagihan')
                    ->withSum('payment', 'total_bayar')
                    ->withSum('payment', 'denda')
                    ->where('status_pelanggan', 1)
                    ->where('is_valid', 1)
                    ->whereHas('payment', function ($query) {
                        $query->where('status_pembayaran', 1);
                    })
                    ->get();

                $pageData['range'] = $data['range'];
                $pageData['customer'] = $customer;

            }

            if ($page === 'ikhtisar-lpp' || $page === 'penerimaan-penagihan') {
                $pelanggan = Customers::query()
                    ->with(['payment', 'golonganTarif', 'zona'])
                    ->withSum('payment', 'total_tagihan')
                    ->withSum('payment', 'pemakaian_air_saat_ini')
                    ->withSum('payment', 'harga_air')
                    ->withSum('payment', 'dana_meter')
                    ->withSum('payment', 'biaya_layanan')
                    ->withSum('payment', 'total_bayar')
                    ->withSum('payment', 'denda')
                    ->when($range, function ($query) use ($start, $end) {
                        $query->whereHas('payment', function ($query) use ($start, $end) {
                            $query->whereBetween('tgl_bayar', [$start, $end]);
                        });
                    })
                    ->groupBy('golongan_id')
                    ->limit(15)
                    ->get();

                $pembayaran = Payment::query()
//                    ->with(['customer', 'customer.zona', 'customer.golonganTarif'])
                    ->when($range, function ($query) use ($start, $end) {
                        $query->whereBetween('tgl_bayar', [$start, $end]);
                    })
                    ->when($filterZona, function ($query) use ($filterZona) {
                        $query->whereHas('customer', function ($query) use ($filterZona) {
                            $query->where('zona_id', $filterZona);
                        });
                    })
//            ->groupBy('customer_id')
                    ->get()
                    ->groupBy(function ($item) {
                        return $item->customer->zona->wilayah;
                    });
                $pageData['pelanggan'] = $pelanggan;
                $pageData['customer'] = $pelanggan;
                $pageData['pembayaran'] = $pembayaran;
                $tipe = 'stream';
            }

            if($page === 'rekening-air') {
                $view = 'laporan.partials.rekening-air';
                $pelanggan = Customers::with(['payment', 'golonganTarif', 'statusPelanggan', 'zona', 'metodeBayar'])->find($data['id']);
                $pembayaran = $pelanggan->payment()->with('metodeBayar')->latest()->find($data['pembayaran_id']);
                $pageData['pelanggan'] = $pelanggan;
                $pageData['pembayaran'] = $pembayaran;
                $pageData['pembayaran_id'] = $data['pembayaran_id'];
                $tipe = 'stream';
            }

            if($page === 'catat-meter')
            {
               $catatMeter = App\Models\CatatMeter::with(['customer','customer.golonganTarif','petugas'])->get();
               $pageData['catatMeter'] = $catatMeter;
            }
        }

        return $this->sendToPrint($pageData, $tipe, $view, $page);
    }

    public function showBuktiBayar($page, $pelangganId, $pembayaranId)
    {
        $filename = isset($page) ? 'laporan-'.$page.'-'.now()->format('YmdHis').'.pdf' : 'laporan-'.now()->format('YmdHis').'.pdf';
        $pelanggan = Customers::with(['payment', 'golonganTarif', 'statusPelanggan', 'zona', 'metodeBayar'])->find($pelangganId);
        $pembayaran = $pelanggan->payment()->with('metodeBayar')->latest()->find($pembayaranId);
        $pageData['pelanggan'] = $pelanggan;
        $pageData['pembayaran'] = $pembayaran;
        $pageData['id'] = $pelangganId ?? 1;
        $pageData['pembayaran_id'] = $pembayaranId;
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('laporan.bukti-bayar.'.$page, $pageData);
        $pdf->setPaper('a4', setting('print_layout', 'portrait'))->setWarnings(false);
        return $pdf->stream($filename);
    }

    protected function sendToPrint($data, $tipe, $view, $page)
    {
        $savePath = storage_path('app/public/cetak/');
        $filename = isset($page) ? 'laporan-'.$page.'-'.now()->format('YmdHis').'.pdf' : 'laporan-'.now()->format('YmdHis').'.pdf';
        $pdf = App::make('dompdf.wrapper');
        $paper = 'portrait';
        $pdf->loadView($view, $data);

        if ($page === 'ikhtisar-lpp' || $page === 'penerimaan-penagihan') {
            $paper = 'landscape';
        }

        $pdf->setPaper('a4', $paper)->setWarnings(false);

        if ($tipe === 'download') {
            $pdf->save($savePath . $filename);
            return $pdf->download($filename);
        }

        return $pdf->stream();
    }
}
