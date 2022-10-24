<?php

namespace App\Models;

use Deligoez\LaravelModelHashId\Traits\HasHashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @mixin IdeHelperMetodeBayar
 */
class MetodeBayar extends Model
{
    use HasFactory;
    use LogsActivity;
    use Searchable;
    use HasHashId;

    protected $fillable = ['kode', 'nama', 'no_rekening', 'deskripsi'];

    public $timestamps = false;

    protected $table = 'metode_bayar';

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    #[ArrayShape(['id' => 'int', 'kode' => 'mixed|null|string', 'nama' => 'mixed|string', 'no_rekening' => 'mixed|null|string', 'deskripsi' => 'mixed|null|string'])]
    #[SearchUsingPrefix(['id', 'kode'])]
    #[SearchUsingFullText(['nama', 'deskripsi'])]
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'kode' => $this->kode,
            'nama' => $this->nama,
            'no_rekening' => $this->no_rekening,
            'deskripsi' => $this->deskripsi,
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('metode-bayar')
            ->setDescriptionForEvent(fn ($eventName) => "Aktifitas {$eventName} data metode bayar {$this->nama}");
        // Chain fluent methods for configuration options
    }
}
