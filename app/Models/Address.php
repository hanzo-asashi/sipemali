<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @mixin IdeHelperAddress
 */
class Address extends Model
{
    use HasFactory;
    use LogsActivity;
    use Searchable;

    protected $fillable = ['alamat'];

    public $timestamps = false;
//    protected $table = 'alamats';

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
//    #[SearchUsingPrefix(['id'])]
    #[ArrayShape(['alamat' => 'string'])] #[SearchUsingFullText(['alamat'])]
    public function toSearchableArray(): array
    {
        return [
            //            'id' => $this->id,
            'alamat' => $this->alamat,
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('alamat')
            ->setDescriptionForEvent(fn ($eventName) => "Aktifitas {$eventName} data alamat {$this->alamat}");
        // Chain fluent methods for configuration options
    }

//    public function scopeSearch($query, $term)
//    {
//        $term = "%{$term}%";
//        $query->where('alamat', 'like', $term)
//            ->orWhere('blok', 'like', $term);
//    }
}
