<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperJenisTarif
 */
class JenisTarif extends Model
{
    use HasFactory;

    public $table = 'jenis_tarif';

    protected $fillable = ['jenis', 'nilai', 'keterangan'];
    public $timestamps = false;

    public function reklame()
    {
        return $this->belongsTo(JenisReklame::class, 'jenis_tarif', 'id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('jenis', 'like', $term)
            ->orWhere('nilai', 'like', $term)
            ->orWhere('keterangan', 'like', $term);
    }
}
