<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperJenisBahanBakuMineral
 */
class JenisBahanBakuMineral extends Model
{
    use HasFactory;

    public $table = 'jenis_bahanbaku_mineral';

    protected $fillable = ['nama', 'satuan', 'nilai'];
    public $timestamps = false;

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('nama', 'like', $term)
            ->orWhere('satuan', 'like', $term)
            ->orWhere('nilai', 'like', $term);
    }

    public function bahanbakumineral()
    {
        return $this->hasOne(BahanBakuTambang::class,'id_jenis_bahan_baku','id');
    }
}
