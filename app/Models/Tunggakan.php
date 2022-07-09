<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @mixin IdeHelperTunggakan
 */
class Tunggakan extends Model
{
    use HasFactory, LogsActivity;

    public $table = 'tunggakan';
//    public $timestamps = false;
    protected $fillable = [
        'pembayaran_id', 'tgl_bayar', 'tgl_jatuh_tempo', 'lama_tunggakan', 'jumlah_tagihan', 'jumlah_bayar', 'denda'
        , 'total_tagihan', 'sisa_bayar', 'tagihan_ke', 'status_tunggakan'
    ];
    protected $casts = [
        'tgl_bayar' => 'datetime',
        'tgl_jatuh_tempo' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Tunggakan')
            ->setDescriptionForEvent(fn($eventName) => "{$eventName} tunggakan dengan pembayaran ID: {$this->payment_id}, Total Tagihan: Rp. {$this->total_tagihan}, Denda: Rp. {$this->denda}")
            ->logFillable()
            ->logOnlyDirty();

        // Chain fluent methods for configuration options
    }

    public function pembayaran(): BelongsTo
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id', 'id');
    }

    public function scopeSearch($query, $term): void
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
