<?php

namespace App\Http\Livewire\Transaksi\Pembayaran;

use App\Models\Customers;
use App\Models\GolonganTarif;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\Zone;
use App\Utilities\Helpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;
use Validator;

class EditPembayaran extends Component
{
    use LivewireAlert;
    use UsesSpamProtection;

    public HoneypotData $extraFields;

    public string $title = 'Ubah Pembayaran';
    public $golonganTarif;
    public $customers;
    public $payment;

    public array $pembayaran = [];
    public $data;
    public int $selectedPelanggan;
    public array $selectedItems = [];
    public $customer;
    public string $select2DropdownId = 'select2-dropdown';
    public $pelangganData;
    public $golonganId;
    public $zonaId;
    public int $paymentId;

    /**
     * Computed Property Payment
     * */

    public function getDataPembayaranProperty(): Model|Collection|Builder|array|null
    {
        return Payment::with(['customer', 'customer.golonganTarif'])->find($this->paymentId);
    }


    public function mount(string $id): void
    {
        $id = Helpers::decodeId($id);
        $this->paymentId = $id;
        $payment = $this->dataPembayaran;
        $this->payment = $this->dataPembayaran;
        $this->customers = !is_null($this->payment) ? $this->payment->customer : null;
        $this->golonganTarif = !is_null($this->customers) ? $this->customers->golonganTarif : 0;
        $this->pembayaran['customer_id'] = $payment->customer_id;
        $this->pembayaran['bulan_berjalan'] = $payment->bulan_berjalan;
        $this->pembayaran['tahun_berjalan'] = $payment->tahun_berjalan;
        $this->pembayaran['stand_awal'] = $payment->stand_awal;
        $this->pembayaran['stand_akhir'] = $payment->stand_akhir;
        $this->pembayaran['pemakaian_air_saat_ini'] = $payment->pemakaian_air_saat_ini;
        $this->pembayaran['dana_meter'] = $payment->dana_meter;
        $this->pembayaran['biaya_layanan'] = $payment->biaya_layanan;
        $this->pembayaran['harga_air'] = $this->getTarifAir($payment->pemakaian_air_saat_ini);
        $this->pembayaran['total_tagihan'] = $payment->total_tagihan;
        $this->pembayaran['total_bayar'] = $payment->total_bayar;
        $this->pembayaran['status_pembayaran'] = $payment->status_pembayaran;
        $this->pembayaran['keterangan'] = $payment->keterangan;
        $this->extraFields = new HoneypotData();
    }

    #[Pure] #[ArrayShape(['hargaAir' => 'mixed', 'danaMeter' => 'mixed', 'biayaLayanan' => 'mixed'])] private function hitungHargaAir($value): array
    {
        $hargaAir = $this->getTarifAir($value);
        $danaMeter = $this->golonganTarif->dana_meter;
        $biayaLayanan = $this->golonganTarif->biaya_administrasi;

        return [
            'hargaAir' => $hargaAir,
            'danaMeter' => $danaMeter,
            'biayaLayanan' => $biayaLayanan,
        ];
    }

//    public function updatedSelectedPelanggan()
//    {
//        $this->customer = Customers::find($this->selectedPelanggan);
//        $this->golonganId = $this->customer->golongan_id;
//        $this->zonaId = $this->customer->zona_id;
//        $this->pembayaran['customer_id'] = (int) $this->selectedPelanggan;
//    }

//    public function updatedPembayaranCustomerId($value): void
//    {
//        $this->selectedPelanggan = (int) $value;
//        $this->customer = Customers::find($this->selectedPelanggan);
//        if(!is_null($this->customer)) {
//            if(!$this->customer->is_valid){
//                $this->alert('error', 'PelangganResource tidak valid. Harap validasi pelanggan terlebih dahulu. ');
//                return;
//            }
//            if ($this->customer->status_pelanggan !== 1) {
//                $this->alert('error', 'PelangganResource tidak aktif. Harap aktifkan pelanggan terlebih dahulu. ');
//                return;
//            }
//
//            $this->selectedItems[] = [
//                ['id' => $this->customer->id, 'title' => $this->customer->nama_pelanggan,'subtitle' => $this->customer->no_sambungan],
//            ];
//            $this->pembayaran['stand_awal'] = $this->customer->angka_meter_lama ?? 0;
//            $this->pembayaran['stand_akhir'] = $this->customer->angka_meter_baru ?? 0;
////            $this->pembayaran['pemakaian_air_saat_ini'] = $this->customer->angka_meter_baru - $this->customer->angka_meter_lama;
//            $this->golonganId = $this->customer->golongan_id;
//            $this->zonaId = $this->customer->zona_id;
//            $this->pembayaran['customer_id'] = $this->selectedPelanggan;
//            $this->updatedPembayaranStandAkhir($this->customer->angka_meter_baru);
//        }
//    }

//    public function updatedPembayaranStandAkhir($value): void
//    {
//        $pemakaianAir = (int) $value - (int) $this->pembayaran['stand_awal'];
//        $this->pembayaran['pemakaian_air_saat_ini'] = $pemakaianAir;
//
//        $hitung = $this->hitungHargaAir($pemakaianAir);
//        $this->pembayaran['harga_air'] = $hitung['hargaAir'];
//        $this->pembayaran['dana_meter'] = $hitung['danaMeter'];
//        $this->pembayaran['biaya_layanan'] = $hitung['biayaLayanan'];
//        $this->pembayaran['total_tagihan'] = ($hitung['hargaAir'] * $pemakaianAir) + $hitung['biayaLayanan'];
//    }

    private function getTarifAir($value)
    {
        if ($value >= 0 && $value <= 10) {
            $hargaAir = $this->golonganTarif->tarif_blok_1;
        } elseif ($value >= 11 && $value <= 20) {
            $hargaAir = $this->golonganTarif->tarif_blok_2;
        } elseif ($value >= 21 && $value <= 30) {
            $hargaAir = $this->golonganTarif->tarif_blok_3;
        } elseif ($value >= 31) {
            $hargaAir = $this->golonganTarif->tarif_blok_4;
        } else {
            $hargaAir = $this->golonganTarif->tarif_blok_1;
        }

        return $hargaAir;
    }
//
//    public function updatedPembayaranPemakaianAirSaatIni($value)
//    {
//        $value = (int) $value;
//        $hargaAir = $this->getTarifAir($value);
//
//        $this->pembayaran['harga_air'] = $hargaAir;
//        $this->pembayaran['dana_meter'] = $this->golonganTarif->dana_meter;
//        $this->pembayaran['biaya_layanan'] = $this->golonganTarif->biaya_administrasi;
//        $this->pembayaran['total_tagihan'] = ($hargaAir * $value) + $this->golonganTarif->biaya_administrasi;
//        $this->pembayaran['total_bayar'] = $this->pembayaran['total_tagihan'];
//    }

    public function updatedPembayaranTotalBayar($value): void
    {
        $value = (float) $value;
        $totalTagihan = (float) $this->pembayaran['total_tagihan'];
        if ($value >= $totalTagihan) {
            $this->pembayaran['status_pembayaran'] = 1;
        }

        if ($value < $totalTagihan && $value > 0) {
            $this->pembayaran['status_pembayaran'] = 3;
        }

        if ($value <= 0) {
            $this->pembayaran['status_pembayaran'] = 2;
        }
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function resetForms(): void
    {
        $this->reset('pembayaran');
    }

    public function simpanDanKembali(): void
    {
        $this->updatePembayaran();
        $this->redirectRoute('transaksi.pembayaran.list');
    }

    private function hitungSisa(float $bayar, float $tagihan): float|int
    {
//        $bayar = (float) $bayar;
//        $tagihan = (float) $tagihan;

        if ($bayar > $tagihan) {
            $sisa = $bayar - $tagihan;
        } elseif ($bayar < $tagihan) {
            $sisa = $tagihan - $bayar;
        } else {
            $sisa = 0;
        }
        return $sisa;
    }

    public function updatePembayaran(): void
    {
//        dd($this->pembayaran);
        $validated = Validator::make($this->pembayaran, [
//            'customer_id' => 'required',
            'bulan_berjalan' => 'required',
            'tahun_berjalan' => 'required',
            'total_bayar' => 'required',
            'total_tagihan' => 'required',
            'biaya_layanan' => 'required',
            'dana_meter' => 'required',
            'harga_air' => 'required',
            'pemakaian_air_saat_ini' => 'required',
            'status_pembayaran' => 'required',
            'keterangan' => 'nullable|max:255',
        ])->validate();

        $validated['customer_id'] = $this->payment->customer_id;
        $validated['no_transaksi'] = $this->payment->no_transaksi ?? Helpers::generateNoTransaksi();
        $validated['user_id'] = $this->payment->user_id ?? auth()->user()->id;
        $validated['pemakaian_air_saat_ini'] = $this->payment->pemakaian_air_saat_ini ?? $this->pembayaran['pemakaian_air_saat_ini'];
        $validated['sisa'] = $this->payment->sisa ?? $this->hitungSisa($validated['total_bayar'], $validated['total_tagihan']);

        if ($this->payment->update($validated)) {
            $this->alert('success', 'Pembayaran berhasil diperbarui');
//            $this->resetForms();
        } else {
            $this->alert('danger', 'Pembayaran gagal diperbarui');
        }
//        $this->dispatchBrowserEvent('clearPelanggan');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $listZona = Zone::pluck('wilayah', 'id');
//        $listPelanggan = Customers::pluck('nama_pelanggan', 'id');
        $listGolongan = GolonganTarif::pluck('nama_golongan', 'id');
        $listStatus = PaymentStatus::pluck('name', 'id');

        $listPelanggan = Customers::select('id', 'nama_pelanggan', 'no_pelanggan', 'no_sambungan')
            ->get()
            ->transform(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_pelanggan' => $item->nama_pelanggan,
                    'no_sambungan' => $item->no_sambungan,
                ];
            });

        $listBulan = config('custom.list_bulan');
        $listTahun = config('custom.list_tahun');

        $pageData = [
            'listZona' => $listZona,
            'listPelanggan' => $listPelanggan,
            'listGolongan' => $listGolongan,
            'listStatus' => $listStatus,
            'listBulan' => $listBulan,
            'listTahun' => $listTahun,
        ];
        return view('livewire.transaksi.pembayaran.edit-pembayaran', compact('pageData'))->extends('layouts.contentLayoutMaster');
    }
}
