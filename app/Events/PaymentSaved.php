<?php

namespace App\Events;

use App\Models\Payment;
use App\Models\PaymentHistory;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentSaved
{
    use Dispatchable;

    /**
     * The order instance.
     *
     * @var Payment
     */
    public Payment $payment;

    /**
     * The order instance.
     *
     * @var PaymentHistory
     */
    public PaymentHistory $paymentHistory;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
//        $this->payment = $payment;
        $this->payment = $payment;
//        $createHistory = PaymentHistory::create([
//            'payment_id' => $this->payment->id,
//            'customer_id' => $this->payment->customer_id,
//            'description' => 'Pembayaran dengan no. transaksi #'.$this->payment->no_transaksi . ' sebesar Rp. '.
//                number_format($this->payment->total_tagihan,0,',','.').' telah dibuat',
//            'event' => 'Pembayaran',
//            'meter_awal' => $this->payment->stand_awal,
//            'meter_akhir' => $this->payment->stand_akhir,
//            'pemakaian_air' => $this->payment->pemakaian_air_saat_ini,
//            'dana_meter' => $this->payment->dana_meter,
//            'biaya_layanan' => $this->payment->biaya_layanan,
//            'total_tagihan' => $this->payment->total_tagihan,
//            'user_id' => auth()->user()->id,
//        ]);
//
//        $this->paymentHistory = $createHistory;
    }
}
