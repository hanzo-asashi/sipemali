<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperKategoriReklame
 */
class KategoriReklame extends Model
{
    use HasFactory;

    public $table = 'kategori_reklame';
    public $timestamps = false;
    protected $fillable = ['nama_kategori'];

    public function reklame()
    {
        return $this->belongsTo(ObjekPajakReklame::class,'id_kategori','id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('nama_kategori', 'like', $term);
    }
}
