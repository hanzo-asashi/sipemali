<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\AnggaranOpd;
use App\Models\DaftarOpd;
use App\Models\MetodeBayar;
use App\Models\ObjekPajak;
use App\Models\ObjekPajakTambangMineral;
use App\Models\Pembayaran;
use App\Models\Wilayah;
use App\Utilities\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public array $data = [];
    public mixed $tahun;

    public function index()
    {
        return view('laporan.index');
    }

    private function _realisasiData($request, $periode)
    {
        $objekPajak = ObjekPajak::with(['wajibpajak', 'pembayaran', 'jenisObjekPajak'])
            ->when($request->get('tahun'), function ($q) use ($periode) {
                $q->whereHas('pembayaran', function ($q) use ($periode) {
                    $q->where('tahun', (int) $periode)
                        ->where('status_bayar', 1)
                        ->where('status_transaksi', 1);
                });
            })
            ->whereHas('pembayaran', function ($q) use ($periode) {
                $q->where('tahun', (int) $periode);
            })
            ->groupBy('id_jenis_op')->get();

        $query = Pembayaran::when($request->get('tahun'), function ($q) use ($periode) {
            $q->where('tahun', (int) $periode);
        });

        $totalTarget = $query->sum('nilai_pajak');
        $totalRealisasi = $query->sum('jumlah_bayar');
        $totalDenda = $query->sum('denda');

        $totalTarget2020 = $query->where('status_bayar', 1)
            ->where('tahun', (int) $periode - 1)
            ->sum('nilai_pajak');

        $totalDenda2020 = $query->where('status_bayar', 1)
            ->where('status_transaksi', 2)
            ->where('tahun', (int) $periode - 1)
            ->sum('denda');

        $totalRealisasiNow = $query->where('status_bayar', 1)
            ->where('status_transaksi', 1)
            ->where('tahun', (int) $periode)
            ->sum('jumlah_bayar');

        $totalDendaNow = $query->where('status_bayar', 1)
            ->where('status_transaksi', 2)
            ->where('tahun', (int) $periode)
            ->sum('denda');

        $totalTarget2020 = $totalTarget2020 + $totalDenda2020;
        $totalRealisasiNow = $totalRealisasiNow + $totalDendaNow;
        $totalTarget = $totalTarget + $totalDenda;
        $totalRealisasi = $totalRealisasi + $totalDenda;

        if ($totalTarget > 0 && $totalRealisasiNow > 0) {
            $totalPersen = ($totalRealisasiNow / $totalTarget) * 100;
        } else {
            $totalPersen = 0;
        }

        $totalSisa = $totalTarget - $totalRealisasi + $totalDenda;

        return [
            'objekPajak'        => $objekPajak,
            'totalTarget2020'   => $totalTarget2020,
            'totalRealisasi'    => $totalRealisasi,
            'totalRealisasiNow' => $totalRealisasiNow,
            'totalTarget'       => $totalTarget,
            'totalPersen'       => $totalPersen,
            'totalSisa'         => $totalSisa,
            'totalDenda'        => $totalDenda,
        ];
    }

    public function realisasi(Request $request)
    {
        $page = 'realisasi';
        $periode = $request->has('tahun') ? $request->get('tahun') : setting('tahun_sppt');
        $data = $this->_realisasiData($request, $periode);
        $listTahun = config('custom.tahun_kontrak');

        return view('laporan.realisasi', $data + ['listTahun' => $listTahun, 'periode' => $periode, 'page' => $page]);
    }

    public function jenisPajak(Request $request)
    {
        $page = 'jenis-pajak';
        $periode = $request->has('tahun') ? $request->get('tahun') : setting('tahun_sppt');
        $objekPajak = ObjekPajak::with(['wajibpajak', 'pembayaran', 'jenisObjekPajak'])
            ->orderBy('id_jenis_op')
            ->groupBy('id_jenis_op')
            ->get();
        $listTahun = config('custom.tahun_kontrak');

        return view('laporan.jenis-pajak', compact('page', 'objekPajak', 'periode', 'listTahun'));
    }


    private function _wilayahData(): array
    {
        $wilayah = Wilayah::getWilayah(setting('kode_kabupaten'));
//        $filterKecamatan = !is_null($filterKecamatan) ? $filterKecamatan : setting('kode_kabupaten');
//        $wil = [
//            2 => [5, 'Kota/Kabupaten', 'kab'],
//            5 => [8, 'Kecamatan', 'kec'],
//            8 => [13, 'Kelurahan', 'kel'],
//        ];
//
//        $n = strlen($filterKecamatan) ?: 2;
//        $length = in_array($n, $wil) ?: $wil[$n][0];
//
//        $wilayah = Wilayah::query()->with(['objekpajak','wajibpajak','objekpajak.pembayaran'])
//            ->when($filterKecamatan, function ($q) use($n, $filterKecamatan,$length){
//                $q->whereRaw('LEFT(kode,'.$n.")='{$filterKecamatan}'")
//                    ->whereRaw('CHAR_LENGTH(kode)='.$length);
//            })
//            ->whereRaw('LEFT(kode,'.$n.")='{$filterKecamatan}'")
//            ->whereRaw('CHAR_LENGTH(kode)='.$length)
//            ->orderBy('nama')
//            ->get();

//        $wilayah = Wilayah::getWilayah(setting('kode_kabupaten'));

        return ['wilayah' => $wilayah];
    }

    public function wilayah(Request $request)
    {
        $page = 'wilayah';
        $periode = $request->has('tahun') ? $request->get('tahun') : setting('tahun_sppt');
        $filterKecamatan = $request->has('kecamatan') ? $request->get('kecamatan') : null;
        $filterBulan = $request->has('bulan') ? $request->get('bulan') : null;
        $listKecamatan = Helper::getWilayah(setting('kode_kabupaten'));
        $data = $this->_wilayahData();
        $listTahun = config('custom.tahun_kontrak');
        $listBulan = Helper::list_bulan();

        $data = array_merge($data, [
            'page'            => $page,
            'periode'         => $periode,
            'filterKecamatan' => $filterKecamatan,
            'filterBulan'     => $filterBulan,
            'listKecamatan'   => $listKecamatan,
            'listTahun'       => $listTahun,
            'listBulan'       => $listBulan,
        ]);

        return view('laporan.berdasarkan-wilayah', $data);
    }

    public function metodeBayar(Request $request)
    {
        $page = 'metode-bayar';
        $periode = $request->has('tahun') ? $request->get('tahun') : null;
        $metodeBayar = MetodeBayar::when($periode, function ($q) use ($periode) {
            $q->whereHas('pembayaran', function ($q) use ($periode) {
                $q->where('tahun', $periode);
            });
        })
            ->with('pembayaran','pembayaran.objekpajak')
            ->get();
//        dd($metodeBayar);
//        if (!is_null($metodeBayar)) {
//            foreach ($metodeBayar as $item) {
//                $pembayaran = $item->pembayaran()
//                    ->where('metode_bayar', $item->id);
//
//                $capaian = $item->pembayaran()->sum('nilai_pajak') + $pembayaran->sum('denda');
//                $rm = $item->pembayaran()->where('objek_pajak_id',1)->sum('nilai_pajak') + $pembayaran->where('objek_pajak_id',1)->sum('denda');
//                $htl = $pembayaran->where('objek_pajak_id',2)->sum('nilai_pajak') + $pembayaran->where('objek_pajak_id',2)->sum('denda');
//                $rkl = $pembayaran->where('objek_pajak_id',3)->sum('nilai_pajak') + $pembayaran->where('objek_pajak_id',3)->sum('denda');
//                $tbm = $pembayaran->where('objek_pajak_id',4)->sum('nilai_pajak') + $pembayaran->where('objek_pajak_id',4)->sum('denda');
//                $ppj = $pembayaran->where('objek_pajak_id',5)->sum('nilai_pajak') + $pembayaran->where('objek_pajak_id',5)->sum('denda');
//            }
//            dd($pembayaran->get());
//        }
//        $objekPajak = Pembayaran::with(['wajibpajak', 'objekpajak', 'metodebayar'])
//            ->when($periode, function ($q) use ($periode) {
//                $q->where('tahun', $periode);
//            })
//            ->groupBy('metode_bayar')
//            ->get();
        $listTahun = config('custom.tahun_kontrak');

        return view('laporan.metode-bayar', compact('page', 'periode', 'listTahun', 'metodeBayar'));
    }

    public function realisasiOpd(Request $request)
    {
        $page = 'realisasi-opd';
        $periode = $request->has('tahun') ? $request->get('tahun') : setting('tahun_sppt');
        $filterOpd = $request->has('opd') ? $request->get('opd') : '';
        $daftarOpd = DaftarOpd::with(['belanjaopd', 'belanjaopd.objekPajak'])
            ->when($periode, function ($q) use ($periode) {
                $q->whereHas('belanjaopd', function ($q) use ($periode) {
                    $q->where('tahun', $periode);
                });
            })
            ->when($filterOpd, function ($q) use ($filterOpd) {
                $q->whereHas('belanjaopd', function ($q) use ($filterOpd) {
                    $q->where('opd_id', $filterOpd);
                });
            })
            ->get();
        $opd = DaftarOpd::pluck('nama_opd', 'id');
        $anggaran = AnggaranOpd::with('opd', 'belanja')
            ->withSum('belanja', 'jumlah_transaksi')
            ->when($periode, function ($q) use ($periode) {
                $q->where('tahun', $periode);
            })
            ->when($filterOpd, function ($q) use ($filterOpd) {
                $q->where('opd_id', $filterOpd);
            })
            ->groupBy('opd_id')->get();
        $listTahun = config('custom.tahun_kontrak');
//        $perkiraanMakanMinum = TargetPajak::when($request->has('tahun_pajak'), function ($q) use ($periode) {
//            $q->where('tahun', $periode);
//        })
//            ->where('id_jenis_objek_pajak', 1)->get()->first()->target ?: 0;
//        $perkiraanHotel = TargetPajak::when($request->has('tahun_pajak'), function ($q) use ($periode) {
//            $q->where('tahun', $periode);
//        })
//            ->where('id_jenis_objek_pajak', 2)->get()->first()->target ?: 0;
        return view('laporan.realisasi-opd', compact('page', 'opd', 'filterOpd',
            'anggaran', 'periode', 'listTahun', 'daftarOpd'
        ));
    }

    public function belanjaOpd(Request $request)
    {
        $page = 'belanja-opd';
        $periode = $request->has('tahun') ? $request->get('tahun') : setting('tahun_sppt');
        $filterOpd = $request->has('opd') ? $request->get('opd') : '';
        $daftarOpd = DaftarOpd::with(['belanjaopd', 'belanjaopd.objekPajak'])
            ->when($periode, function ($q) use ($periode) {
                $q->whereHas('belanjaopd', function ($q) use ($periode) {
                    $q->where('tahun', $periode);
                });
            })
            ->when($filterOpd, function ($q) use ($filterOpd) {
                $q->whereHas('belanjaopd', function ($q) use ($filterOpd) {
                    $q->where('opd_id', $filterOpd);
                });
            })
            ->get();
        $opd = DaftarOpd::pluck('nama_opd', 'id');
        $listTahun = config('custom.tahun_kontrak');

        return view('laporan.belanja-opd', compact('page', 'periode', 'opd', 'filterOpd', 'daftarOpd', 'listTahun'));
    }

    public function tambangMineral(Request $request)
    {
        $page = 'tambang-mineral';
        $periode = $request->has('tahun') ? $request->get('tahun') : setting('tahun_sppt');
        $tambang = ObjekPajakTambangMineral::with(['objekPajak', 'objekPajak.pembayaran', 'objekPajak.wajibpajak'])->get();
        $objekPajak = ObjekPajak::with(['wajibpajak', 'objekPajakTambang', 'pembayaran'])
            ->when($periode, function ($q) use ($periode) {
                $q->whereHas('pembayaran', function ($q) use ($periode) {
                    $q->where('tahun', $periode);
                });
            })
            ->where('id_jenis_op', 4)
            ->get();
        $listTahun = config('custom.tahun_kontrak');

        return view('laporan.tambang-mineral', compact('page', 'periode', 'objekPajak', 'listTahun', 'tambang'));
    }

    public function showPrintBukti($page, $op)
    {
//        $objekPajak = ObjekPajak::with(['wajibpajak','jenisObjekPajak','pembayaran'])->find($op);
        $pembayaran = Pembayaran::with(['objekpajak', 'wajibpajak'])->find($op);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('transaksi-pajak.bukti-cetak.'.$page, ['pembayaran' => $pembayaran]);
        $pdf->setPaper('a4', setting('print_layout', 'portrait'))->setWarnings(false);
        $fileName = 'laporan Cetak Bukti '.$page.'.pdf';

        return $pdf->stream();
    }

    public function showPrintPage(Request $request)
    {
        $data = collect();
        $availablePage = ['realisasi', 'jenis-pajak', 'wilayah', 'metode-bayar', 'realisasi-opd', 'belanja-opd','tambang-mineral'];
        $page = $request->has('page') ? $request->get('page') : null;
        $periode = $request->has('periode') ? $request->get('periode') : setting('tahun_sppt');
        $filterKecamatan = $request->has('kecamatan') ? $request->get('kecamatan') : null;
        $filterBulan = $request->has('bulan') ? $request->get('bulan') : null;
        $filterOpd = $request->has('opd') ? $request->get('opd') : '';
        if (in_array($page, $availablePage)) {
            if ($page === 'realisasi') {
                $data = $this->_realisasiData($request, $periode) + ['periode' => $periode, 'page' => $page];
            }

            if ($page === 'jenis-pajak') {
                $objekPajak = ObjekPajak::with(['wajibpajak', 'pembayaran', 'jenisObjekPajak'])
                    ->orderBy('id_jenis_op')
                    ->groupBy('id_jenis_op')
                    ->get();

                $data = [
                    'objekPajak' => $objekPajak,
                    'periode'    => $periode,
                ];
            }

            if ($page === 'wilayah') {
                $objekPajak = $this->_wilayahData();

                $data = $objekPajak + [
                        'periode'         => $periode,
                        'filterKecamatan' => $filterKecamatan,
                        'filterBulan'     => $filterBulan,
                    ];
            }

            if ($page === 'metode-bayar') {
                $metodeBayar = MetodeBayar::all();
                $data = [
                    'metodeBayar' => $metodeBayar,
                    'periode'     => $periode,
                ];
            }

            if ($page === 'realisasi-opd') {
//                $anggaran = AnggaranOpd::with('opd', 'belanja')
//                    ->when($request->has('tahun'), function ($q) use ($periode) {
//                        $q->where('tahun', $periode);
//                    })
//                    ->groupBy('opd_id')->get();
                $daftarOpd = DaftarOpd::with(['belanjaopd', 'belanjaopd.objekPajak'])
                    ->when($periode, function ($q) use ($periode) {
                        $q->whereHas('belanjaopd', function ($q) use ($periode) {
                            $q->where('tahun', $periode);
                        });
                    })
                    ->when($filterOpd, function ($q) use ($filterOpd) {
                        $q->whereHas('belanjaopd', function ($q) use ($filterOpd) {
                            $q->where('opd_id', $filterOpd);
                        });
                    })
                    ->get();
                $opd = DaftarOpd::pluck('nama_opd', 'id');
                $anggaran = AnggaranOpd::with('opd', 'belanja')
                    ->when($periode, function ($q) use ($periode) {
                        $q->where('tahun', $periode);
                    })
                    ->when($filterOpd, function ($q) use ($filterOpd) {
                        $q->where('opd_id', $filterOpd);
                    })
                    ->groupBy('opd_id')->get();
                $listTahun = config('custom.tahun_kontrak');
                $data = [
                    'anggaran'  => $anggaran,
                    'periode'   => $periode,
                    'opd'       => $opd,
                    'filterOpd' => $filterOpd,
                    'listTahun' => $listTahun,
                ];
            }
            if ($page === 'belanja-opd') {
                $filterOpd = $request->has('opd') ? $request->get('opd') : '';
                $daftarOpd = DaftarOpd::with(['belanjaopd', 'belanjaopd.objekPajak'])
                    ->when($periode, function ($q) use ($periode) {
                        $q->whereHas('belanjaopd', function ($q) use ($periode) {
                            $q->where('tahun', $periode);
                        });
                    })
                    ->when($filterOpd, function ($q) use ($filterOpd) {
                        $q->whereHas('belanjaopd', function ($q) use ($filterOpd) {
                            $q->where('opd_id', $filterOpd);
                        });
                    })
                    ->get();
                $opd = DaftarOpd::pluck('nama_opd', 'id');
                $data = [
                    'filterOpd' => $filterOpd,
                    'daftarOpd' => $daftarOpd,
                    'opd'       => $opd,
                ];
            }

            if ($page === 'tambang-mineral') {
                $tambang = ObjekPajakTambangMineral::with(['objekPajak', 'objekPajak.pembayaran', 'objekPajak.wajibpajak'])->get();
                $objekPajak = ObjekPajak::with(['wajibpajak', 'objekPajakTambang', 'pembayaran'])
                    ->when($periode, function ($q) use ($periode) {
                        $q->whereHas('pembayaran', function ($q) use ($periode) {
                            $q->where('tahun', $periode);
                        });
                    })
                    ->where('id_jenis_op', 4)
                    ->get();
                $listTahun = config('custom.tahun_kontrak');
                $data = [
                    'tambang' => $tambang,
                    'objekPajak' => $objekPajak,
                    'listTahun'       => $listTahun,
                ];
            }

            return $this->renderPrint($page, $data, '');
        }
    }

    public function exportToExcel(Request $request)
    {
        $data = collect();
        $availablePage = ['realisasi', 'jenis-pajak', 'wilayah', 'metode-bayar', 'realisasi-opd', 'belanja-opd','tambang-mineral'];
        $page = $request->has('page') ? $request->get('page') : null;
        $periode = $request->has('periode') ? $request->get('periode') : setting('tahun_sppt');
        $filterKecamatan = $request->has('kecamatan') ? $request->get('kecamatan') : null;
        $filterBulan = $request->has('bulan') ? $request->get('bulan') : null;
        $filterOpd = $request->has('opd') ? $request->get('opd') : '';

        if(in_array($page, $availablePage)){
            $fileName = 'laporan-'.$page.'.pdf';
        }

        return new LaporanExport();
    }

    private function renderDownload($page, array $data, $output)
    {
        $fileName = 'laporan-'.$page.'.pdf';
        $availablePage = ['realisasi', 'jenis-pajak', 'wilayah', 'metode-bayar', 'realisasi-opd', 'belanja-opd','tambang-mineral'];
        return Excel::download(new LaporanExport, 'laporan-'.$page.'.xlsx');
    }

    public function downloadPdf($page, $data)
    {
        $availablePage = ['realisasi', 'jenis-pajak', 'wilayah', 'metode-bayar', 'skpd', 'sts','tambang-mineral'];
        if (in_array($page, $availablePage)) {
            return $this->renderPrint($page, $data, 'pdf');
        }
    }

    private function renderPrint($page, array $data, $output)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('laporan.preview.'.$page, $data);
        $fileName = 'laporan-'.$page.'.pdf';
        $availablePage = ['realisasi', 'jenis-pajak', 'wilayah', 'metode-bayar', 'realisasi-opd', 'belanja-opd','tambang-mineral'];
        if (in_array($page, $availablePage)) {
            $pdf->setPaper('a4', 'landscape')->setWarnings(false);
        }

        if (is_string($output) && $output == 'pdf') {
            return $pdf->download($fileName);
        }

        return $pdf->stream();
    }


}
