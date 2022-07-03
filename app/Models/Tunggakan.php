<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTunggakan
 */
class Tunggakan extends Model
{
    use HasFactory;

    public $table = 'tunggakan';
//    public $timestamps = false;
    protected $fillable = ['pembayaran_id', 'tgl_bayar','tgl_jatuh_tempo','lama_tunggakan','jumlah_tagihan','jumlah_bayar','denda'
                           ,'total_tagihan','sisa_bayar','tagihan_ke','status_tunggakan'];
    protected $casts = [
        'tgl_bayar' => 'datetime',
        'tgl_jatuh_tempo' => 'datetime',
    ];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class,'pembayaran_id','id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('tgl_bayar', 'like', $term)
            ->orWhere('tgl_jatuh_tempo', 'like', $term)
            ->orWhere('lama_tunggakan', 'like', $term)
            ->orWhere('pembayaran_id', 'like', $term)
            ->orWhere('jumlah_tagihan', 'like', $term)
            ->orWhere('jumlah_bayar', 'like', $term)
            ->orWhere('denda', 'like', $term)
            ->orWhere('total_tagihan', 'like', $term)
            ->orWhere('sisa_bayar', 'like', $term)
            ->orWhere('tagihan_ke', 'like', $term)
            ->orWhere('status_tunggakan', 'like', $term)
            ->orWhereHas('pembayaran', function ($query) use ($term) {
                $query->where('no_transaksi', 'like', $term)
                    ->orWhere('nomor_sts')
                    ->orWhere('jatuh_tempo')
                ;
            })
        ;
    }
}
