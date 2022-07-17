<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @mixin IdeHelperStatus
 */
class Status extends Model
{
    use HasFactory;
    use LogsActivity;

    public $timestamps = false;

    protected $fillable = ['nama_status', 'shortcode'];

    protected $casts = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Status Pelanggan')
            ->setDescriptionForEvent(fn ($eventName) => "Aktifitas {$eventName} status pelanggan {$this->name}");
        // Chain fluent methods for configuration options
    }
}
