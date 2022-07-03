<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @mixin IdeHelperBankAccount
 */
class BankAccount extends Model
{
    use HasFactory;
    use LogsActivity;

    public $timestamps = false;
    protected $fillable = ['name', 'account_number','bank_name'];
    protected $casts = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Bank')
            ->setDescriptionForEvent(fn($eventName) => "{$eventName} akun {$this->bank_name}");
        // Chain fluent methods for configuration options
    }
}
