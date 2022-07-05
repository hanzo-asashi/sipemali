<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @mixin IdeHelperPaymentStatus
 */
class PaymentStatus extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'status_pembayaran';
    public $timestamps = false;
    protected $fillable = ['name','shortcode','keterangan'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Status PembayaranPajak')
            ->setDescriptionForEvent(fn($eventName) => "Aktifitas {$eventName} status pembayaran {$this->name}");
        // Chain fluent methods for configuration options
    }
}
