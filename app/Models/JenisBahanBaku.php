<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperJenisBahanBaku
 */
class JenisBahanBaku extends Model
{
    use HasFactory;

    public $table = 'jenis_bahan_baku';
    public $timestamps = false;
    protected $fillable = ['nama', 'shortcode'];

    public function objekPajakTambangMineral()
    {
        return $this->belongsTo(ObjekPajakTambangMineral::class,'id','id');
    }

    public function bahanBakuTambang()
    {
        return $this->belongsTo(BahanBakuTambang::class,'id','id_jenis_bahan_baku');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('nama', 'like', $term)
            ->orWhere('shortcode', 'like', $term);
    }
}
