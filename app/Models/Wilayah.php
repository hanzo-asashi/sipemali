<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Wilayah_C;

/**
 * @mixin IdeHelperWilayah
 */
class Wilayah extends Model
{
    protected $table = 'wilayah_2020';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode',
        'nama',
    ];


    public static function getWilayah($kode): _IH_Wilayah_C|Collection|array
    {
        $wil = [
            2 => [5, 'Kota/Kabupaten', 'kab'],
            5 => [8, 'Kecamatan', 'kec'],
            8 => [13, 'Kelurahan', 'kel'],
        ];

        $n = strlen($kode) ?: 2;
        $length = in_array($n, $wil, true) ?: $wil[$n][0];

        return self::query()->with(['wajibpajak','objekpajak','objekpajak.jenisObjekPajak','objekpajak.pembayaran'])
            ->whereRaw('LEFT(kode,'.$n.")='{$kode}'")
            ->whereRaw('CHAR_LENGTH(kode)='.$length)
            ->orderBy('nama')
            ->get();
    }

    public static function getWilayahName($kode): Wilayah
    {
        return self::where('kode', $kode)->first();
    }
}
