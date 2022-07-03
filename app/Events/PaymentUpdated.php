<?php

namespace App\Events;

use App\Models\Payment;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Payment
     */
    public Payment $payment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
}
