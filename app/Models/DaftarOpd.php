<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperDaftarOpd
 */
class DaftarOpd extends Model
{
    use HasFactory;

    public $table = 'daftar_opd';
    public $timestamps = false;
    protected $fillable = ['nama_opd'];

    public function belanjaopd()
    {
        return $this->belongsTo(BelanjaOpd::class,'id','opd_id');
    }

    public function anggaranopd()
    {
        return $this->belongsTo(AnggaranOpd::class,'id','opd_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('nama_opd', 'like', $term);
    }
}
