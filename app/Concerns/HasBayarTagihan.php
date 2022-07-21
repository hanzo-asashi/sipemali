<?php

namespace App\Concerns;

use App\Utilities\Helpers;
use JetBrains\PhpStorm\ArrayShape;

//use Jantinnerezo\LivewireAlert\LivewireAlert;

trait HasBayarTagihan
{
//    use LivewireAlert;

    /* Pembayaran instance */
    public array $pembayaran = [];
    public int $pelangganId = 0;
    public int $pembayaranId;

//    public function updateStatus($id): void
//    {
//        $this->pelangganId = $id;
//
//        $this->confirm('Anda yakin pelanggan ini valid ??', [
//            'onConfirmed' => 'updateStatusConfirmed',
//            'confirmButtonText' => 'Ya, Ubah',
//        ]);
//    }

//    public function updatedPembayaranStandAkhir($value): void
//    {
//        $pemakaianAir = (int) $this->pembayaran['stand_awal'] - (int) $value;
//        $this->pembayaran['pemakaian_air_saat_ini'] = $pemakaianAir;
//
//        $hitung = $this->hitungHargaAir($pemakaianAir, Helpers::getModelInstance('GolonganTarif'));
//        $this->pembayaran['harga_air'] = $hitung['hargaAir'];
//        $this->pembayaran['dana_meter'] = $hitung['danaMeter'];
//        $this->pembayaran['biaya_layanan'] = $hitung['biayaLayanan'];
//        $this->pembayaran['total_tagihan'] = ($hitung['hargaAir'] * $pemakaianAir) + $hitung['biayaLayanan'];
//    }

    public function updatedPembayaranPemakaianAirSaatIni($value): void
    {
        $hitung = $this->hitungHargaAir($value, Helpers::getModelInstance('GolonganTarif'));
        $this->pembayaran['harga_air'] = $hitung['hargaAir'];
        $this->pembayaran['dana_meter'] = $hitung['danaMeter'];
        $this->pembayaran['total_tagihan'] = ($hitung['hargaAir'] * $value) + $hitung['biayaLayanan'];
    }

    #[ArrayShape(['hargaAir' => "mixed", 'danaMeter' => "mixed", 'biayaLayanan' => "mixed"])]
    private function hitungHargaAir($value, $model): array
    {
        $mGolongan = $model::find($this->golonganId);

        if ($value >= 0 && $value <= 10) {
            $hargaAir = $mGolongan->tarif_blok_1;
        } elseif ($value >= 11 && $value <= 20) {
            $hargaAir = $mGolongan->tarif_blok_2;
        } elseif ($value >= 21 && $value <= 30) {
            $hargaAir = $mGolongan->tarif_blok_3;
        } elseif ($value >= 31) {
            $hargaAir = $mGolongan->tarif_blok_4;
        } else {
            $hargaAir = $mGolongan->tarif_blok_1;
        }

        $danaMeter = $mGolongan->dana_meter;
        $biayaLayanan = $mGolongan->biaya_administrasi;

        return [
            'hargaAir' => $hargaAir,
            'danaMeter' => $danaMeter,
            'biayaLayanan' => $biayaLayanan,
        ];
    }

}
