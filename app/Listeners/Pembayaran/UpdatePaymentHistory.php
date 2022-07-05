<?php

namespace App\Listeners\Pembayaran;

use App\Events\PaymentCreated;
use App\Models\PaymentHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatePaymentHistory
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
        return PaymentHistory::update([
//            'payment_id' => $event->id,
//            'customer_id' => $event->customer_id,
            'description' => 'PembayaranPajak dengan no. transaksi #'.$event->payment->no_transaksi . ' sebesar Rp. '.
                number_format($event->payment->total_tagihan,0,',','.').' telah diperbaharui',
            'event' => 'Ubah PembayaranPajak',
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
