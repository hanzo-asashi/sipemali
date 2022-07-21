<?php

namespace App\Models;

//use App\Concerns\HasHashId;
use Deligoez\LaravelModelHashId\Traits\HasHashId;
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

//    use HasHashIdRouting;

    protected $table = 'pelanggan';
//    protected $with = ['statusPelanggan','zona','golonganTarif','payment'];

    protected $fillable = [
        'no_sambungan', 'no_pelanggan', 'nama_pelanggan', 'alamat_pelanggan', 'zona_id', 'golongan_id', 'bulan_langganan', 'tahun_langganan',
        'status_pelanggan', 'penagihan_pelanggan', 'is_valid', 'keterangan',
    ];

    protected $casts = [
        'is_valid' => 'boolean',
        'tahun_langganan' => 'integer',
        'bulan_langganan' => 'integer',
    ];

    protected $appends = ['angka_meter_lama', 'angka_meter_baru'];

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
            get: fn () => ! is_null($meter) ? $meter->angka_meter_baru : 0,
            set: fn ($value) => $this->attributes['angka_meter_baru'] = $value,
        );
    }

    protected function angkaMeterLama(): Attribute
    {
        $meter = CatatMeter::where('customer_id', $this->id)->first();

        return new Attribute(
            get: fn () => ! is_null($meter) ? $meter->angka_meter_lama : 0,
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
        return $this->hasMany(Payment::class, 'customer_id', 'id');
    }

    public function paymentHistory(): HasManyThrough
    {
        return $this->hasManyThrough(PaymentHistory::class, Payment::class, 'customer_id', 'customer_id');
    }

    public function metodeBayar(): HasOneThrough
    {
        return $this->hasOneThrough(MetodeBayar::class, Payment::class, 'metode_bayar', 'id');
    }

    public static function checkValidPelanggan($id): bool|int
    {
        $pelanggan = self::find($id);

        return $pelanggan->is_valid === 1 || $pelanggan->is_valid === true;
    }

    public function scopeStatusPelanggan($query, $term)
    {
        return $query->where('status_pelanggan', $term);
    }

    public function scopeValidPelanggan($query, $term)
    {
        return $query->where('is_valid', $term);
    }

    public function scopeSearch($query, $term): void
    {
        $term = "{$term}%";
        $query->where('no_sambungan', 'like', $term)
            ->orWhere('nama_pelanggan', 'like', $term)
            ->orWhere('alamat_pelanggan', 'like', $term);
//            ->orWhereHas('statusPelanggan', function ($query) use ($term) {
//                $query->select('nama_status')->where('nama_status', 'like', $term);
//            })
//            ->orWhereHas('zona', function ($query) use ($term) {
//                $query->select('wilayah')->where('wilayah', 'like', $term);
//            })
//            ->orWhereHas('golonganTarif', function ($query) use ($term) {
//                $query->select('nama_golongan')->where('nama_golongan', 'like', $term);
//            });
    }

    public function getCountValidPelanggan($term = true)
    {
        return $this->query()
            ->select('is_valid')
            ->when($this->search, function ($query) {
                return $query->search($this->search);
            })
            ->when($this->zona, function ($q) {
                $q->whereHas('zona', function ($q) {
                    return $q->where('id', $this->zona);
                });
            })
            ->when($this->status, function ($q) {
                $q->whereHas('statusPelanggan', function ($q) {
                    return $q->where('id', $this->status);
                });
            })
            ->when($this->golongan, function ($q) {
                $q->whereHas('golonganTarif', function ($q) {
                    return $q->where('id', $this->golongan);
                });
            })
            ->when($this->valid, function ($q) {
                return $q->where('is_valid', (int) $this->valid);
            })
            ->where('is_valid', $term)->get()->count();
    }
}
