<?php

namespace App\Events;

use App\Models\CatatMeter;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CatatMeterCreated
{
    use Dispatchable;
    use SerializesModels;

    public CatatMeter $catatMeter;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(CatatMeter $catatMeter)
    {
        $this->catatMeter = $catatMeter;
    }
}
