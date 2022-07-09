<?php

namespace App\Http\Livewire\Transaksi\Pembayaran;

use App\Models\Customers;
use App\Models\GolonganTarif;
use App\Models\MetodeBayar;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\Zone;
use App\Utilities\Helpers;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class CreatePembayaran extends Component
{
    use LivewireAlert;
    use UsesSpamProtection;

    public HoneypotData $extraFields;

    public string $title = 'Buat Pembayaran';
    public Payment $payment;
    public array $pembayaran = [];
    public array $data;
    public $selectedPelanggan;
    public $selectedItems = [];
    public $customer;
    public string $select2DropdownId = 'select2-dropdown';
    public $pelangganData;
    public int $golonganId;
    public int $zonaId;
    public int $pembayaranId;
    public int $pelangganId;

    private string $redirectRoute = 'transaksi.pembayaran.list';

    public function mount(Payment $payment): void
    {
        $this->payment = $payment;
        $this->defaultFieldValue();
        $this->extraFields = new HoneypotData();
    }

    private function defaultFieldValue(): void
    {
        $this->pembayaran['bulan_berjalan'] = setting('bulan_berjalan', now()->month);
        $this->pembayaran['tahun_berjalan'] = setting('tahun_berjalan', now()->year);
        $this->pembayaran['status_pembayaran'] = 2;
        $this->pembayaran['metode_bayar'] = 1;
    }

    public function updatedPembayaranCustomerId($value): void
    {
        $this->selectedPelanggan = (int) $value;
        $this->customer = Customers::find($this->selectedPelanggan);
        if(!is_null($this->customer)) {
            if(!$this->customer->is_valid){
                $this->alert('error', 'Pelanggan tidak valid. Harap validasi pelanggan terlebih dahulu. ');
                return;
            }
            if ($this->customer->status_pelanggan !== 1) {
                $this->alert('error', 'Pelanggan tidak aktif. Harap aktifkan pelanggan terlebih dahulu. ');
                return;
            }

            $this->selectedItems[] = [
                ['id' => $this->customer->id, 'title' => $this->customer->nama_pelanggan,'subtitle' => $this->customer->no_sambungan],
            ];
            $this->pembayaran['stand_awal'] = $this->customer->angka_meter_lama ?? 0;
            $this->pembayaran['stand_akhir'] = $this->customer->angka_meter_baru ?? 0;
//            $this->pembayaran['pemakaian_air_saat_ini'] = $this->customer->angka_meter_baru - $this->customer->angka_meter_lama;
            $this->golonganId = $this->customer->golongan_id;
            $this->zonaId = $this->customer->zona_id;
            $this->pembayaran['customer_id'] = $this->selectedPelanggan;
            $this->updatedPembayaranStandAkhir($this->customer->angka_meter_baru);
        }
    }

//    public function updatedSelectedPelanggan()
//    {
//        $this->customer = Customers::find($this->selectedPelanggan);
//        if(!is_null($this->customer)) {
//            $this->golonganId = $this->customer->golongan_id;
//            $this->zonaId = $this->customer->zona_id;
//            $this->pembayaran['customer_id'] = (int) $this->selectedPelanggan;
//        }
//    }

    private function hitungHargaAir($value, $model): array
    {
        $golongan = $model::find($this->golonganId);

        if ($value >= 0 && $value <= 10) {
            $hargaAir = $golongan->tarif_blok_1;
        } elseif ($value >= 11 && $value <= 20) {
            $hargaAir = $golongan->tarif_blok_2;
        } elseif ($value >= 21 && $value <= 30) {
            $hargaAir = $golongan->tarif_blok_3;
        } elseif ($value >= 31) {
            $hargaAir = $golongan->tarif_blok_4;
        } else {
            $hargaAir = $golongan->tarif_blok_1;
        }

        $danaMeter = $golongan->dana_meter;
        $biayaLayanan = $golongan->biaya_administrasi;
//        $this->pembayaran['dana_meter'] = $golongan->dana_meter;
//        $this->pembayaran['biaya_layanan'] = $golongan->biaya_administrasi;

        return [
            'hargaAir' => $hargaAir,
            'danaMeter' => $danaMeter,
            'biayaLayanan' => $biayaLayanan,
        ];
    }

    public function updatedPembayaranStandAkhir($value): void
    {
        $pemakaianAir = (int) $value - (int) $this->pembayaran['stand_awal'];
        $this->pembayaran['pemakaian_air_saat_ini'] = $pemakaianAir;

        $hitung = $this->hitungHargaAir($pemakaianAir, Helpers::getModelInstance('GolonganTarif'));
        $this->pembayaran['harga_air'] = $hitung['hargaAir'];
        $this->pembayaran['dana_meter'] = $hitung['danaMeter'];
        $this->pembayaran['biaya_layanan'] = $hitung['biayaLayanan'];
        $this->pembayaran['total_tagihan'] = ($hitung['hargaAir'] * $pemakaianAir) + $hitung['biayaLayanan'];
    }

    public function updatedPembayaranPemakaianAirSaatIni($value): void
    {
        $value = (int) $value;
        $hitung = $this->hitungHargaAir($value, Helpers::getModelInstance('GolonganTarif'));
        $this->pembayaran['harga_air'] = $hitung['hargaAir'];
        $this->pembayaran['dana_meter'] = $hitung['danaMeter'];
        $this->pembayaran['biaya_layanan'] = $hitung['biayaLayanan'];
        $this->pembayaran['total_tagihan'] = ($hitung['hargaAir'] * $value) + $hitung['biayaLayanan'];
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function resetForms(): void
    {
        $this->reset('pembayaran');
        $this->defaultFieldValue();
        $this->redirectRoute($this->redirectRoute);
    }

    /**
     * @throws Exception
     */
    public function buatDanKembali(): void
    {
        $this->storePembayaran();
        $this->redirectRoute($this->redirectRoute);
    }

    /**
     * @throws Exception
     */
    public function simpanDanCetak(): void
    {
        $this->storePembayaran();
        $this->redirectRoute('cetak.bukti-pembayaran', [
            'page' => 'rekening-air',
            'pelangganId' => $this->pelangganId,
            'pembayaranId' => $this->pembayaranId,
        ]);
        $this->dispatchBrowserEvent('print', [
            'url' => route('cetak.bukti-pembayaran', [
                'page' => 'rekening-air',
                'pelangganId' => $this->pelangganId,
                'pembayaranId' => $this->pembayaranId,
            ])
        ]);
    }

    private function hitungSisa($bayar, $tagihan): float|int
    {
        $bayar = (float) $bayar;
        $tagihan = (float) $tagihan;

        if($bayar > $tagihan){
            $sisa = $bayar - $tagihan;
        }elseif($bayar < $tagihan){
            $sisa = $tagihan - $bayar;
        }else{
            $sisa = 0;
        }
        return $sisa;
    }

    /**
     * @throws Exception
     */
    public function storePembayaran(): void
    {
        $this->protectAgainstSpam(); // if is spam, will abort the request

        $validated = \Validator::make($this->pembayaran, [
            'customer_id' => 'required',
            'bulan_berjalan' => 'required',
            'tahun_berjalan' => 'required',
            'stand_awal' => 'required',
            'stand_akhir' => 'required',
            'total_bayar' => 'required',
            'total_tagihan' => 'required',
            'biaya_layanan' => 'required',
            'dana_meter' => 'required',
            'harga_air' => 'required',
            'pemakaian_air_saat_ini' => 'required',
            'status_pembayaran' => 'required',
            'keterangan' => 'nullable|max:255',
        ])->validate();

        $tglPembayaran = setting('tgl_pembayaran', now()->day);
        $validated['no_transaksi'] = Helpers::generateNoTransaksi();
        $validated['user_id'] = auth()->user()->id;
        $validated['pemakaian_air_sebelumnya'] = $validated['pemakaian_air_saat_ini'] ?? old('pemakaian_air_saat_ini');
        $validated['sisa'] = $this->hitungSisa($validated['total_bayar'], $validated['total_tagihan']);
        $validated['tgl_bayar'] = now();
        $validated['periode'] = Carbon::createFromDate($validated['tahun_berjalan'], $validated['bulan_berjalan'], $tglPembayaran);
        $validated['tgl_jatuh_tempo'] = Carbon::createFromDate($validated['tahun_berjalan'], $validated['bulan_berjalan'], $tglPembayaran)->addMonths(1);

        $exist = $this->payment->checkExistPayment($validated['customer_id'], $validated['bulan_berjalan'], $validated['tahun_berjalan'])
//            ->where('customer_id', $validated['customer_id'])
//            ->where('bulan_berjalan', $validated['bulan_berjalan'])
//            ->where('tahun_berjalan', $validated['tahun_berjalan'])
            ->get()->first();

        if($exist && $exist->status_pembayaran !== 1){
            $this->alert('error', 'Masih ada pembayaran yang masih tertunggak. Silahkan melunasi pembayaran anda sebelumnya terlebih dahulu.');
            return;
        }

        $create = Payment::updateOrCreate([
            'customer_id' => $validated['customer_id'],
            'bulan_berjalan' => $validated['bulan_berjalan'],
            'tahun_berjalan' => $validated['tahun_berjalan'],
        ], $validated);

        if($create){
//            PaymentCreated::dispatch($create);
            $this->pembayaranId = $create->id;
            $this->pelangganId = $create->customer_id;
            $this->alert('success', 'Pembayaran berhasil ditambahkan');
            $this->resetForms();
        }else{
            $this->alert('danger', 'Pembayaran gagal ditambahkan');
        }
        $this->dispatchBrowserEvent('clearPelanggan');
    }

    private function checkExistPayment($customerId, $bulan, $tahun)
    {
        return $this->payment->where('customer_id', $customerId)
            ->where('bulan_berjalan', $bulan)
            ->where('tahun_berjalan', $tahun)
            ->get()->first();
    }

    public function render(): Factory|View|Application
    {
        $listZona = Zone::pluck('wilayah', 'id');
//        $listPelanggan = Customers::pluck('nama_pelanggan', 'id');
        $listPelanggan = Customers::select('id','nama_pelanggan', 'no_pelanggan','no_sambungan')
            ->get()
            ->transform(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_pelanggan' => $item->nama_pelanggan,
                    'no_sambungan' => $item->no_sambungan,
                ];
            });
        $listGolongan = GolonganTarif::pluck('nama_golongan', 'id');
        $listStatus = PaymentStatus::pluck('name', 'id');
        $listMetode = MetodeBayar::pluck('nama', 'id');

        $listBulan = config('custom.list_bulan');
        $listTahun = config('custom.list_tahun');

        $pageData = [
            'listZona' => $listZona,
            'listPelanggan' => $listPelanggan,
            'listGolongan' => $listGolongan,
            'listStatus' => $listStatus,
            'listMetode' => $listMetode,
            'listBulan' => $listBulan,
            'listTahun' => $listTahun,
        ];

        return view('livewire.transaksi.pembayaran.create-pembayaran', compact('pageData'));
    }
}
