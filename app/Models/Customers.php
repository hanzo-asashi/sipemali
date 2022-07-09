<?php

namespace App\Models;

use App\Concerns\HasHashId;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @mixin IdeHelperCustomers
 */
class Customers extends Model
{
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;
    use HasHashId;
    use CausesActivity;
    use HasApiTokens;

    protected $table = 'pelanggan';
//    protected $with = ['statusPelanggan','zona','golonganTarif','payment'];

    protected $fillable = [
        'no_sambungan','no_pelanggan','nama_pelanggan','alamat_pelanggan','zona_id','golongan_id','bulan_langganan','tahun_langganan',
        'status_pelanggan','penagihan_pelanggan','is_valid','keterangan'
    ];

    protected $casts = [
        'is_valid' => 'boolean',
    ];

    protected $appends = ['angka_meter_lama','angka_meter_baru'];

//    protected function jumlahKuitansi(): Attribute
//    {
//        $kuitansi = Payment::where('customer_id', $this->id)->count();
//        return new Attribute(
//            get: fn () => !is_null($kuitansi) ? $kuitansi : 0,
//        );
//    }

    protected function angkaMeterBaru(): Attribute
    {
        $meter = CatatMeter::where('customer_id', $this->id)->first();
        return new Attribute(
            get: fn () => !is_null($meter) ? $meter->angka_meter_baru : 0,
            set: fn ($value) => $this->attributes['angka_meter_baru'] = $value,
        );
    }

    protected function angkaMeterLama(): Attribute
    {
        $meter = CatatMeter::where('customer_id', $this->id)->first();
        return new Attribute(
            get: fn () => !is_null($meter) ? $meter->angka_meter_lama : 0,
            set: fn ($value) => $this->attributes['angka_meter_lama'] = $value,
        );
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('customers')
            ->setDescriptionForEvent(fn ($eventName) => "Aktifitas {$eventName} data pelanggan {$this->nama_pelanggan}")
            ->logFillable()
            ->logOnlyDirty();

        // Chain fluent methods for configuration options
    }

    public function statusPelanggan(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_pelanggan', 'id');
    }

    public function catatmeter(): HasOne
    {
        return $this->hasOne(CatatMeter::class, 'customer_id', 'id');
    }

    public function golonganTarif(): BelongsTo
    {
        return $this->belongsTo(GolonganTarif::class, 'golongan_id', 'id');
    }

    public function zona(): BelongsTo
    {
        return $this->belongsTo(Zone::class, 'zona_id', 'id');
    }

    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class, 'customer_id','id');
    }

    public function paymentHistory(): HasManyThrough
    {
        return $this->hasManyThrough(PaymentHistory::class,Payment::class,'customer_id','customer_id');
    }

    public function metodeBayar(): HasOneThrough
    {
        return $this->hasOneThrough(MetodeBayar::class, Payment::class, 'metode_bayar', 'id');
    }

    public static function checkValidPelanggan($id): bool
    {
        $pelanggan = self::find($id);
        return (bool) $pelanggan->is_valid;
    }

    public function scopePelangganDitangguhkan($query)
    {
        return $query->where('status_pelanggan', 2);
    }
    public function scopePelangganDidop($query)
    {
        return $query->where('status_pelanggan', 3);
    }

    public function scopePelangganAktif($query)
    {
        return $query->where('status_pelanggan', 1);
    }

    public function scopeStatusPelanggan($query, $term)
    {
        return $query->where('status_pelanggan', $term);
    }

    public function scopeSearch($query, $term): void
    {
        $term = "%{$term}%";
        $query->where('no_sambungan', 'like', $term)
            ->orWhere('no_pelanggan', 'like', $term)
            ->orWhere('nama_pelanggan', 'like', $term)
            ->orWhere('alamat_pelanggan', 'like', $term)
            ->orWhere('is_valid', '=', $term)
            ->orWhereHas('statusPelanggan', function ($query) use ($term) {
                $query->where('nama_status', '=', $term);
            })
            ->orWhereHas('zona', function ($query) use ($term) {
                $query->where('kode', '=', $term)
                    ->orWhere('wilayah', 'like', $term);
            })
            ->orWhereHas('golonganTarif', function ($query) use ($term) {
                $query->where('nama_golongan', 'like', $term)
                    ->orWhere('kode_golongan', '=', $term);
            });
    }
}
