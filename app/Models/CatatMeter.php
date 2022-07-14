<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @mixin IdeHelperCatatMeter
 */
class CatatMeter extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'catat_meter';
    protected $fillable = [
        'customer_id',
        'user_id',
        'bulan',
        'periode',
        'angka_meter_lama',
        'angka_meter_baru',
        'status_meter',
        'keterangan'
    ];

    protected $dispatchesEvents = [
//        'created' => CatatMeterCreated::class,
//        'updated' => \App\Events\CatatMeterUpdated::class,
//        'deleted' => \App\Events\CatatMeterDeleted::class,
    ];

    protected $casts = [
        'angka_meter_lama' => 'integer',
        'angka_meter_baru' => 'integer',
        'customer_id' => 'integer',
        'user_id' => 'integer',
        'bulan' => 'integer',
        'periode' => 'date',
        'status_meter' => 'boolean',
        'keterangan' => 'string'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Bank')
            ->setDescriptionForEvent(fn($eventName) => "{$eventName} akun {$this->bank_name}");
        // Chain fluent methods for configuration options
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function getAngkaMeterCustomerByMonth($customerId, $month): int
    {
        $catat = self::where('customer_id', $customerId)->where('bulan', $month)->first();

        if ($catat) {
            return $catat->angka_meter_baru;
        }

        return 0;
    }

    public function scopeStatusMeter($query, $term)
    {
        return $query->where('status_meter', $term);
    }

    public function scopeSearch($query, $term): void
    {
        $term = "%{$term}%";
        $query->where('angka_meter_lama', 'like', $term)
            ->orWhere('angka_meter_baru', 'like', $term)
            ->orWhere('status_meter', 'like', $term)
            ->orWhereHas('customer', function ($query) use ($term) {
                $query->where('nama_pelanggan', 'like', $term);
            })
            ->orWhereHas('petugas', function ($query) use ($term) {
                $query->where('name', 'like', $term);
            });
    }
}
