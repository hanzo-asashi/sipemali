<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\GolonganTarif;
use App\Models\Payment;
use App\Models\Zone;
use App\Utilities\Helpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;

class LaporanController extends Controller
{
    public int $perPage;

    public array $pageData;

    public function __construct()
    {
        $this->perPage = config('custom.page_count', 15);
        $this->pageData = [];
    }

    public function index()
    {
        return view('laporan.index');
    }

    public function daftarRekeningDitagih(Request $request)
    {
        $filter = $this->getFilterArray($request);
        $title = 'Daftar Rekening Ditagih';
        $pageName = Helpers::convertTitle($title);
        $periode = $request->get('periode', now()->format('Y-m'));
        $range = $filter['range'];
        $start = $filter['start'];
        $end = $filter['end'];
        $zona = $filter['zona'];
        $golongan = $filter['golongan'];

        $pembayaran = Payment::query()->with(['customer', 'customer.zona', 'customer.golonganTarif'])
            ->when($range, function ($query) use ($start, $end) {
                $query->whereBetween('tgl_bayar', [$start, $end]);
            })
            ->when($zona, function ($query) use ($zona) {
                $query->whereHas('customer.zona', function ($query) use ($zona) {
                    $query->where('kode', $zona);
                });
            })
            ->when($golongan, function ($query) use ($golongan) {
                $query->whereHas('customer.golonganTarif', function ($query) use ($golongan) {
                    $query->where('kode_golongan', $golongan)->groupBy('kode_golongan');
                });
            })
            ->whereHas('customer', function ($query) {
                $query->where('is_valid', true);
            })
            ->whereHas('customer', function ($query) {
                $query->where('status_pelanggan', 1);
            })
            ->where('status_pembayaran', 1)
            ->groupBy('customer_id')
            ->get()
            ->groupBy(function ($item) {
                return $item->customer->golonganTarif->kode_golongan;
            });
//            ->groupBy('customer.zona.id');
        $pelanggan = collect();
//        $pembayaran = collect();
        $filterZona = $request->get('zona', null);
        $listZona = Zone::pluck('wilayah', 'kode');
        $listGolongan = GolonganTarif::pluck('nama_golongan', 'kode_golongan');
        $this->pageData = [
            'page' => $pageName,
            'periode' => $periode,
            'pelanggan' => $pelanggan,
            'range' => $range,
            'pembayaran' => $pembayaran,
            'filterZona' => $filterZona,
            'listZona' => $listZona,
            'listGolongan' => $listGolongan,
        ];
        return view('laporan.daftar-rekening-ditagih', $this->pageData);
    }

    /**
     * @param  Request  $request
     * @return array
     */
    private function getFilterArray(Request $request): array
    {
        $filter = $request->has('filter') ? $request->get('filter') : [];
        $periode_range = $filter['periode_range'] ?? null;
        $range = !is_null($periode_range) ? explode(' - ', $periode_range) : null;
        $start = !is_null($range) ? $range[0] : null;
        $end = !is_null($range) ? $range[1] : null;
        $zona = $filter['z'] ?? null;
        $tipe = $request->has('t') ? $request->get('t') : null;
        $golongan = $filter['golongan'] ?? null;
        return [
            'range' => $range,
            'periode_range' => $periode_range,
            'start' => $start,
            'end' => $end,
            'zona' => $zona,
            'golongan' => $golongan,
            'tipe' => $tipe,
        ];
    }

    /**
     * @param  Request  $request
     * @return array
     */
    private function getFilter(Request $request): array
    {
        $filter = $request->all();
        $range = $request->has('periode_range') ? $filter['periode_range'] : null;
        $range = !is_null($range) ? explode(' - ', $range) : null;
        $start = !is_null($range) ? $range[0] : null;
        $end = !is_null($range) ? $range[1] : null;

        return [
            'range' => $range,
            'zona' => $request->get('zona', null),
            'golongan' => $request->get('golongan', null),
            'start' => $start,
            'end' => $end,
        ];
    }

    public function piutangPelanggan(Request $request)
    {
        $filter = $this->getFilter($request);
        $range = $filter['range'];
        $start = $filter['start'];
        $end = $filter['end'];

        $customer = Customers::with(['payment', 'golonganTarif', 'zona'])
            ->groupBy('golongan_id')
            ->withSum('payment', 'total_tagihan')
            ->when($range, function ($query) use ($start, $end) {
                $query->whereHas('payment', function ($query) use ($start, $end) {
                    $query->whereBetween('tgl_bayar', [$start, $end]);
                });
            })
            ->get();
        return view('laporan.piutang-pelanggan', compact('customer', 'filter'));
    }

    public function piutangKelompok()
    {
        return view('laporan.piutang-kelompok');
    }

    public function opnameFisik(Request $request)
    {
        $title = 'Opname Fisik';
        $reqFilter = $this->filterCustomer($request);
        $range = $reqFilter['range'];
        $start = $reqFilter['start'];
        $end = $reqFilter['end'];
        $pageName = 'opname-fisik';

//        $customer = $this->customerQuery($request);
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
            ->paginate($this->perPage);

        $this->pageData = [
            'customer' => $customer,
            'title' => $title,
            'range' => $range ?: '',
            'start' => $start ?: '',
            'end' => $end ?: '',
            'totalData' => $customer->total(),
            'pageCount' => $customer->perPage(),
            'page' => $customer->currentPage(),
            'pageName' => $pageName
        ];
//        dd($customer->links());
        return view('laporan.opname-fisik', $this->pageData);
    }

    #[ArrayShape(['filter' => '', 'range' => 'null|string[]', 'start' => 'null|string', 'end' => 'null|string'])] private function filterCustomer($filter): array
    {
        $range = $filter->has('periode_range') ? $filter['periode_range'] : null;
        $range = !is_null($range) ? \explode(' - ', $range) : null;
        $start = !is_null($range) ? $range[0] : null;
        $end = !is_null($range) ? $range[1] : null;

        return [
            'filter' => $filter,
            'range' => $range,
            'start' => $start,
            'end' => $end,
        ];
    }

    private function customerQuery($filter, $tipe = 'pelanggan')
    {
        $filter = $this->filterCustomer($filter);
        $range = $filter['range'];
        $start = $filter['start'];
        $end = $filter['end'];

        $customer = Customers::query()
            ->select([
                'pelanggan.id',
                'pelanggan.no_sambungan',
                'pelanggan.no_pelanggan',
                'pelanggan.nama_pelanggan',
                'pelanggan.alamat_pelanggan',
                'pelanggan.golongan_id',
                'pelanggan.status_pelanggan',
                'pelanggan.is_valid',
                'pembayaran.id as pembayaran_id',
                'pembayaran.customer_id',
                'pembayaran.bulan_berjalan',
                'pembayaran.tahun_berjalan',
                'pembayaran.tgl_jatuh_tempo',
                'pembayaran.tgl_bayar',
                'pembayaran.stand_awal',
                'pembayaran.stand_akhir',
                'pembayaran.pemakaian_air_saat_ini',
                'pembayaran.harga_air',
                'pembayaran.dana_meter as pembayaran_dana_meter',
                'pembayaran.biaya_layanan',
                'pembayaran.total_tagihan',
                'pembayaran.total_bayar',
                'pembayaran.denda',
                'pembayaran.sisa',
                'pembayaran.status_pembayaran',
                'pembayaran.metode_bayar',
                'pembayaran.keterangan',
                'golongan_tarif.id as golongan_tarif_id',
                'golongan_tarif.nama_golongan',
                'golongan_tarif.kode_golongan',
                'golongan_tarif.blok_1',
                'golongan_tarif.blok_2',
                'golongan_tarif.blok_3',
                'golongan_tarif.blok_4',
                'golongan_tarif.tarif_blok_1',
                'golongan_tarif.tarif_blok_2',
                'golongan_tarif.tarif_blok_3',
                'golongan_tarif.tarif_blok_4',
                'golongan_tarif.biaya_administrasi',
                'golongan_tarif.dana_meter',
                'golongan_tarif.tarif_pasang_baru',
                'golongan_tarif.tgl_bayar_akhir',
            ])->from('pelanggan')
            ->leftJoin('pembayaran', 'pembayaran.customer_id', '=', 'pelanggan.id')
            ->leftJoin('golongan_tarif', 'golongan_tarif.id', '=', 'pelanggan.golongan_id')
            ->when($range, function ($query) use ($start, $end) {
                $query->whereBetween('pembayaran.tgl_bayar', [$start, $end]);
            })
            ->where('pelanggan.is_valid', 1)
            ->where('pelanggan.status_pelanggan', 1)
            ->orderBy('pelanggan.id')
            ->paginate(config('custom.perPage', $this->perPage));

        if ($tipe === 'kelompok') {
            return $customer->groupBy(['golongan_tarif_id' => function ($item) {
                return $item->nama_golongan;
            }]);
        }

//        if($tipe === 'opname'){
//            return $customer->groupBy(['pembayaran.bulan_berjalan' => function ($item) {
//                return $item->bulan_berjalan;
//            }]);
//        }

        return $customer;
    }

    public function umurPiutangPelanggan(Request $request)
    {
        $title = 'Umur Piutang Pelanggan';
        $pageData = $this->getReqFilter($request, $title);

        return view('laporan.umur-piutang-pelanggan', $pageData);
    }

    public function umurPiutangKelompok(Request $request)
    {
        $title = 'Umur Piutang Kelompok';
        $pageData = $this->getReqFilter($request, $title);

        return view('laporan.umur-piutang-kelompok', $pageData);
    }

    public function transaksi()
    {
        return view('laporan.transaksi');
    }

    public function pelanggan()
    {
        return view('laporan.pelanggan');
    }

    public function rekeningAir()
    {
        return view('laporan.rekening-air');
    }

    public function perhitungan()
    {
        return view('laporan.transaksi');
    }

    private function getCustomerQuery($range, $start, $end)
    {
        $start = $start ?? now()->firstOfMonth()->toDateString();
        $end = $end ?? now()->endOfMonth();
        return Customers::query()
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
    }

    private function getPembayaranQuery($range, $start, $end, $filterZona)
    {
        return Payment::query()
            ->with(['customer', 'customer.zona', 'customer.golonganTarif'])
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
    }

    public function penerimaanPenagihan(Request $request)
    {
        $filter = $this->getFilterArray($request);
        $range = $filter['range'];
        $start = !is_null($filter['start']) ? $filter['start'] : now()->firstOfMonth()->toDateString();
        $end = !is_null($filter['end']) ? $filter['end'] : now()->endOfMonth()->toDateString();
        $filterZona = $filter['zona'];

        $periode_range = $filter['periode_range'];
        $tipe = $request->has('t') ? $request->get('t') : null;
        $customer = $this->getCustomerQuery($range, $start, $end);
        $pembayaran = $this->getPembayaranQuery($range, $start, $end, $filterZona);

        $listZona = Zone::pluck('wilayah', 'id');

        $start = Helpers::tanggal($start);
        $end = Helpers::tanggal($end);
//        $page = $tipe === 'ikh' ? 'ikhtisar-lpp' : 'penerimaan-penagihan';

        if($tipe === 'ikh'){
            $page = 'ikhtisar-lpp';
        }elseif($tipe === 'lpp'){
            $page = 'penerimaan-penagihan';
        }else{
            $page = 'custom';
        }

        $this->pageData = [
            'filter' => $filter,
            'periode_range' => $periode_range,
            'customer' => $customer,
            'pelanggan' => $customer,
            'pembayaran' => $pembayaran,
            'listZona' => $listZona,
            'tipe' => $tipe,
            'page' => $page,
            'periode' => $range,
            'range' => $range,
            'start' => $start,
            'end' => $end,
            'filterZona' => $filterZona,
        ];

        if ($tipe === 'ikh') {
            return view('laporan.ikhtisar-lpp', $this->pageData);
        }

        if($tipe === 'custom'){
            return view('laporan.custom', $this->pageData);
        }

        return view('laporan.penerimaan-penagihan', $this->pageData);
    }

    /**
     * @param  Request  $request
     * @param  string  $title
     * @return array
     */
    public function getReqFilter(Request $request, string $title): array
    {
        $reqFilter = $this->filterCustomer($request);
        $range = $reqFilter['range'];
        $start = $reqFilter['start'];
        $end = $reqFilter['end'];

        $customer = $this->customerQuery($request);

        return [
            'filter' => $request->all(),
            'customer' => $customer,
            'title' => $title,
            'range' => $range,
            'start' => $start,
            'end' => $end,
            'totalData' => $customer->total(),
            'pageCount' => $this->perPage ?? $customer->perPage(),
            'page' => $customer->currentPage(),
        ];
    }
}
