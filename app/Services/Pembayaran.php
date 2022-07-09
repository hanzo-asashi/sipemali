<?php

namespace App\Services;

class Pembayaran
{
    public $pembayaran;

    public static function hitungHargaAir($pemakaian, $golonganTarif): float|int
    {
        $hargaAir = 0;
        $pemakaian = $pemakaian ?? 0;
        $golonganTarif = $golonganTarif ?? 0;
        return $pemakaian * $golonganTarif;
    }
}
