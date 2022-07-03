<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTipeSatuan
 */
class TipeSatuan extends Model
{
    use HasFactory;

    public $table = 'tipe_satuan';

    protected $fillable = ['satuan', 'keterangan'];
    public $timestamps = false;

    public function reklame()
    {
        return $this->belongsTo(JenisReklame::class, 'tipe_satuan', 'id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('satuan', 'like', $term)
            ->orWhere('keterangan', 'like', $term);
    }
}
