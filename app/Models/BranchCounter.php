<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @mixin IdeHelperBranchCounter
 */
class BranchCounter extends Model
{
    use HasFactory;
    use LogsActivity;

    public $timestamps = false;

    protected $fillable = ['branch_code', 'name', 'description'];

    protected $casts = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Loket')
            ->setDescriptionForEvent(fn ($eventName) => "{$eventName} loket {$this->name}");
        // Chain fluent methods for configuration options
    }
}
