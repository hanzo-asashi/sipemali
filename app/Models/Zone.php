<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @mixin IdeHelperZone
 */
class Zone extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'wilayah','kode',
    ];

    protected $table = 'zona_wilayah';
    public $timestamps = false;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'id', 'zona_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Zona')
            ->setDescriptionForEvent(fn($eventName) => "Aktifitas {$eventName} zona {$this->name}");
        // Chain fluent methods for configuration options
    }
}
