<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperJenisReklame
 */
class JenisReklame extends Model
{
    use HasFactory;

    public $table = 'jenis_reklame';
    public $timestamps = false;
    protected $fillable = ['nama_jenis_op', 'periode_pembayaran', 'nilai_strategis', 'nilai_jual_objek_pajak', 'tipe_satuan', 'jenis_tarif'];

    public function tarif()
    {
        return $this->hasOne(JenisTarif::class, 'id', 'jenis_tarif');
    }

    public function satuan()
    {
        return $this->hasOne(TipeSatuan::class, 'id', 'tipe_satuan');
    }

    public function reklame()
    {
        return $this->belongsTo(ObjekPajakReklame::class,'id_jenis_reklame','id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('nama_jenis_op', 'like', $term)
            ->orWhere('periode_pembayaran', 'like', $term)
            ->orWhere('nilai_strategis', 'like', $term)
            ->orWhere('nilai_jual_objek_pajak', 'like', $term)
            ->orWhere('tipe_satuan', 'like', $term)
            ->orWhereHas('tarif', function ($query) use ($term) {
                $query->where('jenis', 'like', $term)->orWhere('nilai', 'like', $term);
            })
            ->orWhereHas('satuan', function ($query) use ($term) {
                $query->where('satuan', 'like', $term);
            });
    }
}
