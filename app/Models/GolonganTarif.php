<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @mixin IdeHelperGolonganTarif
 */
class GolonganTarif extends Model
{
    use HasFactory;
    use LogsActivity;
    use Searchable;

    protected $table = 'golongan_tarif';
    public $timestamps = false;


    protected $fillable = [
        'kode_golongan','nama_golongan','deskripsi','blok_1','blok_2','blok_3','blok_4','tarif_blok_1','tarif_blok_2','tarif_blok_3','tarif_blok_4',
        'biaya_administrasi','dana_meter','tarif_pasang_baru','tgl_bayar_akhir','denda_bln_1','denda_bln_2','denda_lebih_2_bln'
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    #[SearchUsingPrefix(['kode_golongan'])]
    #[SearchUsingFullText(['nama_golongan','deskripsi'])]
    public function toSearchableArray()
    {
        return [
//            'id' => $this->id,
            'kode_golongan' => $this->kode_golongan,
            'nama_golongan' => $this->nama_golongan,
            'deskripsi' => $this->deskripsi,
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('golongan_tarif')
            ->setDescriptionForEvent(fn($eventName) => "{$eventName} golongan tarif {$this->nama_golongan}");
        // Chain fluent methods for configuration options
    }

    public function customer() : HasOne
    {
        return $this->hasOne(Customers::class, 'golongan_id', 'id');
    }

    public function pelanggan() : BelongsTo
    {
        return $this->belongsTo(Customers::class, 'id', 'golongan_id');
    }

}
