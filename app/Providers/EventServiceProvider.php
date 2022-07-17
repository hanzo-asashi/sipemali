<?php

namespace App\Providers;

use App\Events\CatatMeterCreated;
use App\Events\Customer\SendTagihanNotifications;
use App\Events\PaymentCreated;
use App\Events\PaymentSaved;
use App\Events\PaymentUpdated;
use App\Listeners\CatatMeter\UpdateAngkaMeter;
use App\Listeners\Customer\SendNotifications;
use App\Listeners\Pembayaran\CreatePaymentHistory;
use App\Listeners\Pembayaran\UpdatePaymentHistory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CatatMeterCreated::class => [
            UpdateAngkaMeter::class,
        ],
        PaymentCreated::class => [
            CreatePaymentHistory::class,
        ],
        PaymentUpdated::class => [
            UpdatePaymentHistory::class,
        ],
        //        PaymentSaved::class => [
        //            SendNotifications::class,
        //        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        //        SendTagihanNotifications::class => [
        //            SendNotifications::class
        //        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
