<?php

namespace App\Http\Livewire\WajibPajak;

use App\Models\ObjekPajak;
use App\Models\Pembayaran;
use App\Models\Tunggakan;
use App\Models\WajibPajak;
use Livewire\Component;

class Detail extends Component
{
    public $wajibPajak;
    public $wajibPajakId;
    public $objekPajak;

    public $amount = 5;

    public function mount(WajibPajak $wajibPajak)
    {
        $this->wajibPajak = $wajibPajak;
    }

    public function loadmore()
    {
        $this->amount += 5;
    }

    public function render()
    {
        $detailWajibPajak = $this->wajibPajak
            ->with([
                'objekpajak',
                'objekpajak.objekPajakTambang',
                'objekpajak.objekPajakTambang.bahanbaku',
                'objekpajak.bahanbakutambang',
                'objekpajakrumahmakan',
                'jenisWajibPajak',
                'kab','kec','kel',
                'objekpajak.pembayaran',
                'objekpajak.pembayaran.tunggakan'
            ])
            ->find($this->wajibPajakId);

        $objekPajak = ObjekPajak::with(['objekpajaktambang'])->take($this->amount)->get();
        $pembayaran = Pembayaran::with(['objekpajak.objekPajakRumahMakan','wajibpajak','tunggakan'])
            ->where('wajib_pajak_id', $this->wajibPajakId)
            ->get();
        $tunggakan = Tunggakan::with(['pembayaran'])
            ->where('pembayaran_id', $this->wajibPajakId)
            ->get();

        return view('livewire.wajib-pajak.detail',
            compact('detailWajibPajak','pembayaran','tunggakan','objekPajak'));
    }
}
