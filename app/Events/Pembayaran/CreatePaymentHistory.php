<?php

namespace App\Events\Pembayaran;

use App\Events\PaymentCreated;
use App\Events\PaymentUpdated;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreatePaymentHistory
{
    use Dispatchable, SerializesModels;

    public $createHistory;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PaymentUpdated $event)
    {
        $createHistory = PaymentHistory::create([
            'payment_id' => $event->id,
            'customer_id' => $event->customer_id,
            'description' => 'Pembayaran dengan no. transaksi #'.$event->no_transaksi . ' sebesar Rp. '.
                number_format($event->total_tagihan,0,',','.').' telah dibuat',
            'event' => 'Pembayaran',
            'meter_awal' => $event->stand_awal,
            'meter_akhir' => $event->stand_akhir,
            'pemakaian_air' => $event->pemakaian_air_saat_ini,
            'dana_meter' => $event->dana_meter,
            'biaya_layanan' => $event->biaya_layanan,
            'total_tagihan' => $event->total_tagihan,
            'user_id' => auth()->user()->id,
        ]);

        $this->createHistory = $createHistory;
    }
}
