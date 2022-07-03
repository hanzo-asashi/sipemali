<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperObjekPajakReklame
 */
class ObjekPajakReklame extends Model
{
    use HasFactory;

    protected $table = 'objek_pajak_reklame';
    protected $fillable = [
        'objek_pajak_id',
        'id_kategori',
        'id_jenis_usaha',
        'id_jenis_reklame',
        'izin',
        'panjang',
        'lebar',
        'kuantiti'
    ];

    public function jenis()
    {
        return $this->hasOne(JenisReklame::class,'id','id_jenis_reklame');
    }

    public function kategori()
    {
        return $this->hasOne(KategoriReklame::class,'id','id_kategori');
    }
    public function tipe()
    {
        return $this->hasOne(TipeUsahaReklame::class, 'id','id_jenis_usaha');
    }

}
