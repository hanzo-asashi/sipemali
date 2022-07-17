<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @mixin IdeHelperPaymentHistory
 */
class PaymentHistory extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['payment_id', 'customer_id', 'description', 'event', 'meter_awal', 'meter_akhir', 'pemakaian_air', 'dana_meter', 'biaya_layanan',
        'total_tagihan', 'user_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('payment_history')
            ->setDescriptionForEvent(fn ($eventName) => "{$eventName} riwayat pembayaran ID: {$this->payment_id}, Pelanggan ID: {$this->customer_id}")
            ->logFillable()
            ->logOnlyDirty();

        // Chain fluent methods for configuration options
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }

//
    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
