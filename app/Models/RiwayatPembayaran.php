<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperRiwayatPembayaran
 */
class RiwayatPembayaran extends Model
{
    use HasFactory;

    public $table = 'riwayat_pembayarans';

    public $casts = [
        'tanggal_cetak' => 'datetime:Y-m-d',
    ];

    protected $fillable = [
        'pembayaran_id', 'pembayaran_ke', 'tanggal_cetak', 'jumlah_bayar','pembayaran_bulan'
    ];

    public function pembayaran()
    {
        return $this->belongsTo(PembayaranPajak::class,'id','pembayaran_id');
    }
}
