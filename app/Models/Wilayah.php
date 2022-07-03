<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function objekpajak()
    {
        return $this->hasMany(ObjekPajak::class, 'kecamatan', 'kode');
    }

    public function pembayaran()
    {
        return $this->hasManyThrough(ObjekPajak::class,Pembayaran::class,'objek_pajak_id','id');
    }

    public function wajibpajak()
    {
        return $this->hasOne(WajibPajak::class, 'kecamatan', 'kode');
    }

    public static function getWilayah($kode)
    {
        $wil = [
            2 => [5, 'Kota/Kabupaten', 'kab'],
            5 => [8, 'Kecamatan', 'kec'],
            8 => [13, 'Kelurahan', 'kel'],
        ];

        $n = strlen($kode) ?: 2;
        $length = in_array($n, $wil) ?: $wil[$n][0];

        return self::query()->with(['wajibpajak','objekpajak','objekpajak.jenisObjekPajak','objekpajak.pembayaran'])
            ->whereRaw('LEFT(kode,'.$n.")='{$kode}'")
            ->whereRaw('CHAR_LENGTH(kode)='.$length)
            ->orderBy('nama')
            ->get();
    }

    public static function getWilayahName($kode)
    {
        return self::where('kode', $kode)->first();
    }
}
