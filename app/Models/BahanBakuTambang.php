<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperBahanBakuTambang
 */
class BahanBakuTambang extends Model
{
    use HasFactory;

    public $table = 'bahan_baku_tambang';
    public $timestamps = false;
    protected $fillable = ['id_objek_pajak', 'id_jenis_bahan_baku','jumlah_volume','satuan'];


    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('jumlah_volume', 'like', $term)
            ->orWhere('satuan', 'like', $term)
        ;
    }

    public function jenisbahanbaku()
    {
        return $this->belongsTo(JenisBahanBakuMineral::class,'id_jenis_bahan_baku','id');
    }

    public function tambangmineral()
    {
        return $this->belongsTo(ObjekPajakTambangMineral::class,'id','objek_pajak_id');
    }

    public function objekpajak()
    {
        return $this->belongsTo(ObjekPajak::class,'id_objek_pajak','id');
    }
}
