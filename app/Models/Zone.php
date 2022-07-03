<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    protected $table = 'zona';
    public $timestamps = false;

    public function customer()
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
