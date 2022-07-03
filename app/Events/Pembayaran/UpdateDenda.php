<?php

namespace App\Events\Pembayaran;

use App\Models\Payment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateDenda
{
    use Dispatchable, SerializesModels;

    public Payment $pembayaran;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Payment $pembayaran)
    {
        $this->pembayaran = $pembayaran;
    }
}
