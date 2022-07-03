<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperMetodeBayar
 */
class MetodeBayarPajak extends Model
{
    use HasFactory;

    public $table = 'jenis_metode_pembayaran';

    protected $fillable = ['jenis_metode', 'keterangan'];
    public $timestamps = false;

    public function pembayaran()
    {
//        return $this->belongsTo(Pembayaran::class, 'id', 'metode_bayar');
        return $this->hasMany(Pembayaran::class, 'metode_bayar', 'id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('jenis_metode', 'like', $term)
            ->orWhere('keterangan', 'like', $term);
    }
}
