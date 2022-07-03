<?php

namespace App\Http\Livewire\TransaksiPajak\Pembayaran;

use App\Models\MetodeBayarPajak;
use App\Models\ObjekPajak;
use App\Models\Pembayaran;
use App\Models\WajibPajak;
use App\Utilities\Helper;
use Carbon\Carbon;
use Livewire\Component;

class CreatePembayaran extends Component
{
    public $objekPajakId;
    public $pembayaranId;
    public $pembayaran;
    public $objekPajak;
    public $opid;
    public $wpid;

    public $wajib_pajak_id;
    public $objek_pajak_id;
    public $no_transaksi;
    public $metode_bayar;
    public $tahun;
    public $nomor_sts;
    public $nomor_skpd;
    public $bulan;
    public $jumlah_bayar;
    public $nilai_pajak_sebelumnya;
    public $nilai_pajak;
    public $denda;
    public $sisa;
    public $jatuh_tempo;
    public $status_bayar;
    public $status_transaksi;
    public $keterangan;
    public $tgl_bayar;
    public $listObjekPajak;

    protected $rules
        = [
            'wajib_pajak_id' => 'required',
            'objek_pajak_id' => 'required',
            'tahun'          => 'required',
            'bulan'          => 'required',
            'nilai_pajak'    => 'required',
            'jumlah_bayar'   => 'required',
            'sisa'           => 'required',
            'status_bayar'   => 'required',
            'keterangan'     => 'max:255',
        ];
    public $objekpajakid;
    public $wajibpajakid;
    public $op_id;

//    protected $listeners = ['objekPajakAdded'];
//
//    public function objekPajakAdded(ObjekPajak $objekPajak)
//    {
//        dd($objekPajak);
//        $this->op_id = $id;
//    }

    public function hydrate()
    {
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function mount(Pembayaran $pembayaran)
    {
        if (request()->has('objekpajakid') && request()->has('wajibpajakid')) {
            $this->objek_pajak_id = request()->get('objekpajakid');
            $this->wajib_pajak_id = request()->get('wajibpajakid');
        }

        if (request()->has('opid')) {
            $this->op_id = request()->get('opid');
            $objekPajak = ObjekPajak::find($this->op_id);
            $this->objek_pajak_id = $objekPajak->id;
            $this->wajib_pajak_id = $objekPajak->id_wp;
        }

        $this->pembayaran = $pembayaran;
        $this->no_transaksi = Helper::generateNoTransaksi();
        $this->tahun = setting('tahun_sppt');
        $this->metode_bayar = 1;
        $this->bulan = setting('masa_pajak_bulan');
        $this->status_bayar = 1;

        if (!is_null($this->wajib_pajak_id)) {
            $this->listObjekPajak = ObjekPajak::where('id_wp', $this->wajib_pajak_id)->pluck('nama_objek_pajak', 'id');
        } else {
            $this->wajib_pajak_id = collect();
            $this->listObjekPajak = ObjekPajak::pluck('nama_objek_pajak', 'id');
        }

//        if (!is_null($this->objekpajakid)) {
//            $this->objek_pajak_id = $this->objekpajakid;
//        } else {
//            $this->objek_pajak_id = collect();
//        }
//
//        if (!is_null($this->wajibpajakid)) {
//            $this->wajib_pajak_id = $this->wajibpajakid;
//        } else {
//            $this->wajib_pajak_id = collect();
//        }

    }

    private function resetInput()
    {
        $this->reset('nilai_pajak_sebelumnya', 'nilai_pajak', 'nomor_sts', 'nomor_skpd', 'sisa', 'status_bayar', 'keterangan');
    }

    private function alert($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('alert', $options);
    }

    public function submit()
    {
        $validatedData = $this->validate();

        $exist = $this->pembayaran
            ->where('tahun', $this->tahun)
            ->where('bulan', $this->bulan)
            ->where('wajib_pajak_id', $this->wajib_pajak_id)
            ->where('objek_pajak_id', $this->objek_pajak_id)
            ->exists();

        $objekPajak = ObjekPajak::find($this->objek_pajak_id);

        if (!$exist) {
            if (is_null($this->jatuh_tempo) && $this->nilai_pajak > 0) {
                $tglJatuhTempo = Carbon::parse($date ?? now())->addDays(Helper::jumlah_hari(now()));
                $validatedData['jatuh_tempo'] = $tglJatuhTempo;
            }

            if (is_null($this->nomor_sts) && $this->nilai_pajak > 0) {
                $validatedData['nomor_sts'] = Helper::generateNomorSts($objekPajak->id_jenis_op, $objekPajak->id);
            }

            if (is_null($this->nomor_skpd) && $this->nilai_pajak > 0) {
                $validatedData['nomor_skpd'] = Helper::generateNomorSkpd($objekPajak->id_jenis_op, $objekPajak->id, $this->bulan, $this->tahun);
            }

            $validatedData['nilai_pajak_sebelumnya'] = $this->nilai_pajak;
            $validatedData['no_transaksi'] = $this->no_transaksi;

            if ($this->status_bayar === 1) {
                $validatedData['tgl_bayar'] = now();
            }

            $pembayaran = Pembayaran::create($validatedData);
            if ($pembayaran) {
                $this->alert([
                    'success' => true,
                    'message' => 'Pembayaran pajak berhasil ditambahkan',
                ]);
            } else {
                $this->alert([
                    'success' => false,
                    'message' => 'Pembayaran pajak berhasil ditambahkan',
                ]);
            }
            $this->resetInput();
        } else {
            $this->alert([
                'success' => false,
                'message' => 'Pembayaran untuk bulan terpilih sudah ada',
            ]);
        }
    }

    public function updatedWajibPajakId($value)
    {
        if (!is_null($value)) {
            $this->listObjekPajak = ObjekPajak::where('id_wp', $value)->pluck('nama_objek_pajak', 'id');
        }
        $this->wajib_pajak_id = $value;
    }

    public function updatedJumlahBayar($value)
    {
        if (!is_null($value)) {
            $this->sisa = $this->jumlah_bayar - $this->nilai_pajak;
        }
    }

    public function render()
    {
        $listWajibPajak = WajibPajak::pluck('nama_wp', 'id');
//        $listObjekPajak = ObjekPajak::pluck('nama_objek_pajak','id');
        $listMetodeBayar = MetodeBayarPajak::pluck('jenis_metode', 'id');
        $listBulan = config('custom.bulan');
        $listTahun = config('custom.tahun_kontrak');

        return view('livewire.transaksi-pajak.pembayaran.create-pembayaran',
            compact('listWajibPajak', 'listMetodeBayar', 'listBulan', 'listTahun')
        );
    }
}
