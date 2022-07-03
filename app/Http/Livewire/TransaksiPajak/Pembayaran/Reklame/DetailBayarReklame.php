<?php

namespace App\Http\Livewire\TransaksiPajak\Pembayaran\Reklame;

use App\Models\MetodeBayarPajak;
use App\Models\ObjekPajak;
use App\Models\Pembayaran;
use App\Models\WajibPajak;
use App\Utilities\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class DetailBayarReklame extends Component
{
    public $pembayaran;
    public $objekpajak;
    public $success = false;
    public $message = '';

    public $objekPajakId;

    public $wajib_pajak_id;
    public $objek_pajak_id;
    public $nilai_pajak;
    public $metode_bayar;
    public $tahun;
    public $bulan;
    public $status_bayar;
    public $jumlah_bayar;
    public $sisa;
    public $keterangan;

    public $nomor_sts;
    public $jatuh_tempo;
    public $no_transaksi;

    public $listWajibPajak;
    public $listObjekPajak;

    public array $data = [];
    public $state = [];
    public $showModalBayar = false;
    public $updateMode = false;

//    protected $rules = [
//        'nilai_pajak' => 'required',
//        'metode_bayar' => 'required',
//        'tahun' => 'required',
//        'bulan' => 'required',
//        'status_bayar' => 'required',
//        'jumlah_bayar' => 'required',
//        'sisa' => 'string',
//        'keterangan' => 'max:255',
//    ];

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function bayar(Pembayaran $pembayaran)
    {
        $this->updateMode = true;
        $this->pembayaran = $pembayaran;
        $this->showModalBayar = true;

        $this->state['wajib_pajak_id'] = $this->pembayaran->wajib_pajak_id;
        $this->state['objek_pajak_id'] = $this->pembayaran->objek_pajak_id;
        $this->state['tahun'] = $this->pembayaran->tahun;
        $this->state['bulan'] = $this->pembayaran->bulan;
        $this->state['nilai_pajak'] = (double) $this->pembayaran->nilai_pajak;
        $this->state['jumlah_bayar'] = (double) $this->pembayaran->jumlah_bayar;
        $this->state['sisa'] = $this->pembayaran->sisa;
        $this->state['nomor_sts'] = $this->pembayaran->nomor_sts;
        $this->state['metode_bayar'] = $this->pembayaran->metode_bayar;
        $this->state['status_bayar'] = $this->pembayaran->status_bayar;
        $this->state['no_transaksi'] = $this->pembayaran->no_transaksi ?: Helper::generateNoTransaksi();
        $this->state['keterangan'] = $this->pembayaran->keterangan ?: null;

        $this->openModal(['pembayaran' => $this->pembayaran]);
    }

    private function resetInput()
    {
        $this->reset('nilai_pajak','tahun','bulan','status_bayar','jumlah_bayar','keterangan','metode_bayar','sisa');
    }

    private function closeModal($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('closeModal', $options);
    }

    private function openModal($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('openModal', $options);
    }

    private function alert($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('alert', $options);
    }

    public function mount(ObjekPajak $objekpajak)
    {
        $this->objekpajak = $objekpajak;
        $this->listWajibPajak = WajibPajak::pluck('nama_wp', 'id');
//        $this->listObjekPajak = ObjekPajak::where('id_jenis_op', $this->objekpajak->id_jenis_op)->pluck('nama_objek_pajak', 'id');
        if (!is_null($this->wajib_pajak_id)) {
            $this->listObjekPajak = ObjekPajak::where('id_wp', $this->objekpajak->id)
                ->where('id_jenis_op', $this->objekPajakId)
                ->pluck('nama_objek_pajak', 'id');
        } else {
            $this->wajib_pajak_id = collect();
            $this->listObjekPajak = ObjekPajak::where('id_jenis_op', $this->objekpajak->id_jenis_op)->pluck('nama_objek_pajak', 'id');
        }
    }

    public function updatedStateWajibPajakId($value)
    {
        if (!is_null($value)) {
            $this->listObjekPajak = ObjekPajak::where('id_wp', $value)->where('id_jenis_op', $this->objekPajakId)
                ->pluck('nama_objek_pajak', 'id');
        }
        $this->state['wajib_pajak_id'] = $value;
    }

    public function updatedStateJumlahBayar($value)
    {
        if ($value > $this->state['nilai_pajak']) {
            $sisa = $value - $this->state['nilai_pajak'];
            $this->state['status_bayar'] = 1;
        } elseif ($value < $this->state['nilai_pajak']) {
            $sisa = $this->state['nilai_pajak'] - $value;
            $this->state['status_bayar'] = 0;
        } else {
            $sisa = 0;
            $this->state['status_bayar'] = 1;
        }
        $this->state['sisa'] = number_format($sisa, 0, ',', '.');
    }

    public function submit()
    {
        $validatedData = Validator::make($this->state, [
            'wajib_pajak_id' => 'required',
            'objek_pajak_id' => 'required',
            'metode_bayar'   => 'required',
            'tahun'          => 'required',
            'bulan'          => 'required',
            'nilai_pajak'    => 'required',
            'jumlah_bayar'   => 'required',
            'sisa'           => 'required',
            'status_bayar'   => 'required',
            'keterangan'     => 'max:255',
        ])->validate();

        $generateSkpd = Helper::generateNomorSkpd($this->objekpajak->id_jenis_op, $this->objekpajak->id, $this->state['bulan'], $this->state['tahun']);
        $generateSts = Helper::generateNomorSts($this->objekpajak->id_jenis_op, $this->objekpajak->id_jenis_op);

        $nomorSkpd = $this->pembayaran->nomor_skpd != '' ? $this->pembayaran->nomor_skpd : $generateSkpd;
        $nomorSts = $this->pembayaran->nomor_sts != '' ? $this->pembayaran->nomor_sts : $generateSts;

        $tgl = Carbon::createFromDate($this->state['tahun'], (int) $this->state['bulan'], now()->day)->addMonths(1)->format('Y-m-d');
        $tglJatuhTempo = $this->state['nilai_pajak'] > 0 ? $tgl : null;
        $tglBayar = $this->state['status_bayar'] === '1' ? now() : null;
        $noTransaksi = $this->pembayaran->no_transaksi != '' ? $this->pembayaran->no_transaksi : Helper::generateNoTransaksi();
        //dd($tgl,$tglJatuhTempo,$tglBayar,$noTransaksi);

//        $validatedData['wajib_pajak_id'] = !$this->updateMode ? $this->wajib_pajak_id : $this->pembayaran->wajib_pajak_id;
//        $validatedData['objek_pajak_id'] = !$this->updateMode ? $this->objek_pajak_id : $this->pembayaran->objek_pajak_id;
        $validatedData['metode_bayar'] = !$this->updateMode ? $this->state['metode_bayar'] : $this->pembayaran->metode_bayar;
        $validatedData['nomor_skpd'] = $nomorSkpd;
        $validatedData['nomor_sts'] = $nomorSts;
//        $validatedData['tahun'] = $this->state['tahun'] ?: $this->pembayaran->tahun;
//        $validatedData['bulan'] = $this->state['bulan'] ?: $this->pembayaran->tahun;
        $validatedData['tgl_bayar'] = !is_null($this->pembayaran->tgl_bayar) ? $this->pembayaran->tgl_bayar : $tglBayar;
        $validatedData['jatuh_tempo'] = !is_null($this->pembayaran->jatuh_tempo) ? $this->pembayaran->jatuh_tempo : $tglJatuhTempo;
        $validatedData['jumlah_bayar'] = (double) $this->state['jumlah_bayar'];
        $validatedData['nilai_pajak_sebelumnya'] = (double) $this->state['nilai_pajak'] ?: (double) $this->pembayaran->nilai_pajak_sebelumnya;
        $validatedData['sisa'] = $this->state['sisa'] ?: $this->pembayaran->sisa;
        $validatedData['status_transaksi'] = $this->pembayaran->status_transaksi === 0 ? 1 : $this->pembayaran->status_transaksi;
        $validatedData['no_transaksi'] = !$this->updateMode ? Helper::generateNoTransaksi() : $this->pembayaran->no_transaksi;
        $validatedData['keterangan'] = $this->state['keterangan'] ?: $this->pembayaran->keterangan;

//        $values = [
//            'wajib_pajak_id'         => !$this->updateMode ? $this->wajib_pajak_id : $this->pembayaran->wajib_pajak_id,
//            'objek_pajak_id'         => !$this->updateMode ? $this->objek_pajak_id : $this->pembayaran->objek_pajak_id,
//            'metode_bayar'           => !$this->updateMode ? $this->metode_bayar : $this->pembayaran->metode_bayar,
//            'nomor_skpd'             => !$this->updateMode ? $nomorSkpd : $this->pembayaran->nomor_skpd,
//            'nomor_sts'              => !$this->updateMode ? $nomorSts : $this->pembayaran->nomor_sts,
//            'tahun'                  => $this->tahun ?: $this->pembayaran->tahun,
//            'bulan'                  => $this->bulan ?: $this->pembayaran->bulan,
//            'tgl_bayar'              => !$this->updateMode ? $tglBayar : $this->pembayaran->tgl_bayar,
//            'jatuh_tempo'            => !$this->updateMode ? $tglJatuhTempo : $this->pembayaran->jatuh_tempo,
//            'jumlah_bayar'           => (double) $this->jumlah_bayar ?: (double) $this->pembayaran->jumlah_bayar,
//            'nilai_pajak'            => (double) $this->nilai_pajak ?: (double) $this->pembayaran->nilai_pajak,
//            'nilai_pajak_sebelumnya' => (double) $this->nilai_pajak ?: (double) $this->pembayaran->nilai_pajak_sebelumnya,
//            'sisa'                   => $this->sisa ?: $this->pembayaran->sisa,
//            'status_bayar'           => $this->status_bayar ?: 0,
//            'status_transaksi'       => 1 ?: $this->pembayaran->status_transaksi,
//            'keterangan'             => $this->keterangan ?: $this->pembayaran->keterangan,
//        ];

        if ($this->updateMode) {
//            $bayar = $this->pembayaran->update($values);
            $bayar = $this->pembayaran->update($validatedData);
        } else {
//            $bayar = Pembayaran::create($values);
            $bayar = Pembayaran::create($validatedData);
        }

        if ($bayar) {
            $this->alert([
                'success' => true,
                'message' => 'Pembayaran objek pajak berhasil diperbaharui',
            ]);
        } else {
            $this->alert([
                'success' => true,
                'message' => 'Pembayaran objek pajak gagal diperbaharui',
            ]);
        }
        $this->closeModal();
        $this->resetInput();
    }

    public function cetakSkpd($objekpajak)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('transaksi-pajak.bukti-cetak.skpd');
        $pdf->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->stream();
    }

    public function cetakSts()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('transaksi-pajak.bukti-cetak.sts');
        $pdf->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->stream();
    }

    public function render()
    {
        $listMetodeBayar = MetodeBayarPajak::pluck('jenis_metode','id');
        $listBulan = Helper::list_bulan();
        return view('livewire.transaksi-pajak.pembayaran.reklame.detail-bayar-reklame',
            compact('listMetodeBayar','listBulan'));
    }
}
