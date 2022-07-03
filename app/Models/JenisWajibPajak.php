<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperJenisWajibPajak
 */
class JenisWajibPajak extends Model
{
    use HasFactory;

    public $table = 'jenis_wajib_pajak';
    public $timestamps = false;
    protected $fillable = ['nama_jenis_wp'];

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('nama_jenis_wp', 'like', $term);
    }

    public function wajibPajak()
    {
        return $this->belongsTo(WajibPajak::class, 'id_jenis_wp', 'id');
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'jenis_wp', 'id');
    }
}
