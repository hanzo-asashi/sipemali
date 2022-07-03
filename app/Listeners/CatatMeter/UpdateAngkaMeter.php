<?php

namespace App\Listeners\CatatMeter;

use App\Events\CatatMeterCreated;
use App\Models\CatatMeter;
use App\Models\Customers;
use App\Models\Payment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateAngkaMeter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CatatMeterCreated $event)
    {
        $catatMeter = $event->catatMeter;
        $catatMeter->angka_meter_lama = $catatMeter->angka_meter_baru;
        $catatMeter->save();
        return Customers::find($catatMeter->customer_id)->update([
            'angka_meter_lama' => $catatMeter->angka_meter_lama,
            'angka_meter_baru' => $catatMeter->angka_meter_baru,
        ]);
    }
}
