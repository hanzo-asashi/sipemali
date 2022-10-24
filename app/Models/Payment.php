<?php

namespace App\Models;

use App\Events\PaymentCreated;
use App\Events\PaymentUpdated;
use Deligoez\LaravelModelHashId\Traits\HasHashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @mixin IdeHelperPayment
 */
class Payment extends Model
{
    use HasFactory, LogsActivity, SoftDeletes, HasHashId;

    protected $table = 'pembayaran';

    protected $with = ['customer', 'customer.golonganTarif', 'customer.zona', 'statusPembayaran', 'metodeBayar'];

//    protected $with = ['customer', 'golonganTarif', 'zona', 'statusPembayaran', 'metodeBayar', 'history'];
    protected $dispatchesEvents = [
        'created' => PaymentCreated::class,
        'updated' => PaymentUpdated::class,
    ];

    protected $fillable = [
        'no_transaksi', 'customer_id', 'user_id', 'periode', 'bulan_berjalan', 'tahun_berjalan', 'tgl_jatuh_tempo', 'tgl_bayar',
        'pemakaian_air_saat_ini', 'pemakaian_air_sebelumnya', 'harga_air', 'dana_meter', 'biaya_layanan', 'total_bayar', 'total_tagihan',
        'denda', 'sisa', 'status_pembayaran', 'metode_bayar', 'keterangan', 'stand_awal', 'stand_akhir',
    ];

    protected $casts = [
        'periode' => 'datetime',
        'tgl_bayar' => 'datetime',
        'tgl_jatuh_tempo' => 'date',
        'pemakaian_air_saat_ini' => 'integer',
        'stand_akhir' => 'integer',
        'stand_awal' => 'integer',
        'total_tagihan' => 'double',
        'total_bayar' => 'double',
        'bulan_berjalan' => 'integer',
        'tahun_berjalan' => 'integer',
        'pemakaian_air_sebelumnya' => 'integer',
    ];

//    public function tapActivity(Activity $activity, string $eventName)
//    {
//        $activity->description = "activity.logs.message.{$eventName}";
//    }

    public function getActivitylogOptions(): LogOptions
    {
        $formatNumber = number_format($this->total_tagihan, 0, ',', '.');

        return LogOptions::defaults()
            ->useLogName('pembayaran')
            ->logFillable()
            ->setDescriptionForEvent(fn ($eventName) => ucfirst($eventName)." pembayaran #{$this->no_transaksi} sebesar Rp. {$formatNumber}")
            ->logOnlyDirty();
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }

    public function metodeBayar(): BelongsTo
    {
        return $this->belongsTo(MetodeBayar::class, 'metode_bayar', 'id');
    }

    public function history(): HasMany
    {
        return $this->hasMany(PaymentHistory::class, 'payment_id', 'id');
    }

    public function statusPembayaran(): BelongsTo
    {
        return $this->belongsTo(PaymentStatus::class, 'status_pembayaran', 'id');
    }

    public function golonganTarif(): HasOneThrough
    {
        return $this->hasOneThrough(Customers::class, GolonganTarif::class, 'id', 'golongan_id');
    }

    public function golongan(): HasOneThrough
    {
        return $this->hasOneThrough(GolonganTarif::class, Customers::class, 'golongan_id', 'id');
    }

    public function zona(): HasOneThrough
    {
        return $this->hasOneThrough(Zone::class, Customers::class, 'zona_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeFilterZona($query, $zona)
    {
        return $query->when($zona, function ($q) use ($zona) {
            $q->whereHas('zona', function ($q) use ($zona) {
                return $q->where('id', (int) $zona);
            });
        });
    }

    public function scopeFilterStatus($query, $status)
    {
        return $query->when($status, function ($q) use ($status) {
            $q->whereHas('statusPembayaran', function ($q) use ($status) {
                return $q->where('id', (int) $status);
            });
        });
    }

    public function scopeFilterGolongan($query, $gol)
    {
        return $query->when($gol, function ($q) use ($gol) {
            $q->whereHas('golonganTarif', function ($q) use ($gol) {
                return $q->where('id', (int) $gol);
            });
        });
    }

    public function scopeCheckExistPayment($query, $customerId, $bln, $thn)
    {
        return $query->where('customer_id', $customerId)
            ->where('bulan_berjalan', $bln)
            ->where('tahun_berjalan', $thn);
    }

    public static function checkPembayaran($customerId, $bln, $thn): bool
    {
        $pembayaran = self::where('customer_id', $customerId)
            ->where('bulan_berjalan', $bln)
            ->where('tahun_berjalan', $thn)
            ->where('penagihan_pelanggan', '!=', 'Lunas')
            ->first();

        return (bool) $pembayaran;
    }

    public function scopeSearch($query, $term): void
    {
        $term = "%{$term}%";
        $query->where('periode', 'like', $term)
            ->orWhere('no_transaksi', 'like', $term)
            ->orWhereHas('statusPembayaran', function ($query) use ($term) {
                $query->where('name', 'like', $term);
            })
            ->orWhereHas('user', function ($query) use ($term) {
                $query->where('name', 'like', $term);
            })
            ->orWhereHas('metodeBayar', function ($query) use ($term) {
                $query->where('nama', '=', $term);
            })
            ->orWhereHas('customer', function ($query) use ($term) {
                $query->where('nama_pelanggan', 'like', $term)
                    ->orWhereHas('golonganTarif', function ($query) use ($term) {
                        $query->where('nama_golongan', 'like', $term);
                    })
                    ->orWhereHas('zona', function ($query) use ($term) {
                        $query->where('wilayah', 'like', $term);
                    });
            });
    }
}
