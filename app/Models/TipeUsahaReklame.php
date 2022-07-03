<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTipeUsahaReklame
 */
class TipeUsahaReklame extends Model
{
    use HasFactory;

    public $table = 'tipe_usaha_reklame';
    public $timestamps = false;
    protected $fillable = ['nama_tipe_usaha'];

    public function reklame()
    {
        return $this->belongsTo(ObjekPajakReklame::class,'id_jenis_usaha','id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('nama_tipe_usaha', 'like', $term);
    }
}
