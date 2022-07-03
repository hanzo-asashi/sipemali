<?php

namespace App\Listeners\Pembayaran;

use App\Events\PaymentCreated;
use App\Models\PaymentHistory;

class CreatePaymentHistory
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
     * @param PaymentCreated $event
     * @return bool
     */
    public function handle(PaymentCreated $event)
    {
        return PaymentHistory::create([
            'payment_id' => $event->payment->id,
            'customer_id' => $event->payment->customer_id,
            'description' => 'Pembayaran dengan no. transaksi #'.$event->payment->no_transaksi . ' sebesar Rp. '.
                number_format($event->payment->total_tagihan,0,',','.').' telah dibuat',
            'event' => 'Buat Pembayaran',
            'meter_awal' => $event->payment->stand_awal,
            'meter_akhir' => $event->payment->stand_akhir,
            'pemakaian_air' => $event->payment->pemakaian_air_saat_ini,
            'dana_meter' => $event->payment->dana_meter,
            'biaya_layanan' => $event->payment->biaya_layanan,
            'total_tagihan' => $event->payment->total_tagihan,
            'user_id' => auth()->user()->id,
        ]);
    }
}
