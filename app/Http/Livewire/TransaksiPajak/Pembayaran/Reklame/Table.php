<?php

namespace App\Http\Livewire\TransaksiPajak\Pembayaran\Reklame;

use App\Models\JenisReklame;
use App\Models\MetodeBayarPajak;
use App\Models\ObjekPajak;
use App\Models\Pembayaran;
use App\Models\WajibPajak;
use App\Utilities\Helper;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use Validator;

class Table extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'nama_objek_pajak';
    public int $perPage = 10;
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    public string $selectedStatus = '';
    public string $selectedBulan = '';
    public string $selectedTahun = '';
    public bool $updateMode = false;
    public bool $showModalBayar = false;

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

    public $listWajibPajak;
    public $listObjekPajak;

    public $state = [];

    protected $listeners = ['delete', 'updateNilai'];

    public function updatingSearch()
    {
        $this->resetPage();
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

    public function bayar($objekPajakId)
    {
//        $this->showModalBayar = true;
        $objekPajak = $this->objekPajak->with(['wajibpajak','jenisObjekPajak','pembayaran'])->find($objekPajakId);
        $this->pembayaran = $objekPajak->pembayaran()->get()->first();

        $this->nilai_pajak = (double) $this->pembayaran->nilai_pajak;

        $this->jatuh_tempo = $this->pembayaran->jatuh_tempo;
        $this->tahun = $this->pembayaran->tahun;
        $this->bulan = $this->pembayaran->bulan ?: setting('masa_bulan_pajak');
        $this->nomor_sts = $this->pembayaran->nomor_sts;
        $this->metode_bayar = $this->pembayaran->metode_bayar;
        $this->status_bayar = $this->pembayaran->status_bayar;
        $this->status_transaksi = $this->pembayaran->status_transaksi;
        $this->denda = $this->pembayaran->denda;
        $this->sisa = $this->pembayaran->sisa;
        $this->no_transaksi = $this->pembayaran->no_transaksi ?: Helper::generateNoTransaksi();

        $this->openModal(['pembayaran' => $this->pembayaran]);
    }

    public function isChecked($userid): bool
    {
        return in_array($userid, $this->checked);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = $this->objekPajak->query()
                ->where('id_jenis_op', $this->objekPajakId)
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function resetInput()
    {
        $this->reset('nilai_pajak_sebelumnya', 'nilai_pajak', 'no_transaksi',
            'nomor_sts', 'nomor_skpd', 'sisa', 'status_bayar', 'keterangan'
        );
    }

    private function alert($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('alert', $options);
    }


    public function delete($id, $tipe): ?bool
    {
        if ($tipe === 'bulk') {
            $pembayaran = $this->objekPajak
                ->where('id_jenis_op', $this->objekPajakId)
                ->whereKey($this->checked)
                ->delete();
            $this->checked = [];

            return $pembayaran;
        } else {
            $objek = $this->objekPajak
                ->where('id_jenis_op', $this->objekPajakId)
                ->findOrFail($id);
            if ($objek) {
                $objek->pembayaran->delete();
                $objek->delete();
            }
            return $objek;
        }
    }

    public function mount($id, ObjekPajak $objekPajak, Pembayaran $pembayaran)
    {
        $this->objekPajak = $objekPajak;
        $this->objekPajakId = (int) $id;
        $this->pembayaran = $pembayaran;

        $this->listWajibPajak = WajibPajak::pluck('nama_wp', 'id');

        if (!is_null($this->wajib_pajak_id)) {
            $this->listObjekPajak = ObjekPajak::where('id_wp', $this->wajib_pajak_id)
                ->where('id_jenis_op', $this->objekPajakId)
                ->pluck('nama_objek_pajak', 'id');
        } else {
            $this->wajib_pajak_id = collect();
            $this->listObjekPajak = ObjekPajak::where('id_jenis_op', $this->objekPajakId)->pluck('nama_objek_pajak', 'id');
        }
    }

    public function updatedStateWajibPajakId($value)
    {
        if (!is_null($value)) {
            $this->listObjekPajak = ObjekPajak::where('id_wp', $value)
                ->where('id_jenis_op', $this->objekPajakId)
                ->pluck('nama_objek_pajak', 'id');
        }
        $this->wajib_pajak_id = $value;
    }

    public function tambahBayar($opid)
    {
        $this->updateMode = false;

        $this->objekPajak = ObjekPajak::with('pembayaran')->find($opid);
        $pembayaran = $this->objekPajak->pembayaran->first();

        $this->state['no_transaksi'] = Helper::generateNoTransaksi();
        $this->state['wajib_pajak_id'] = $this->objekPajak->id_wp;
        $this->state['objek_pajak_id'] = $this->objekPajak->id;
        $this->state['metode_bayar'] = 1;
        $this->state['bulan'] = $pembayaran->bulan ?: setting('masa_pajak_bulan');
        $this->state['tahun'] = $pembayaran->tahun ?: setting('tahun_sppt');
        $this->state['nilai_pajak'] = $pembayaran->nilai_pajak ?: $pembayaran->nilai_pajak_sebelumnya;
        $this->state['sisa'] = $pembayaran->sisa ?: 0;
        $this->state['status_bayar'] = $pembayaran->status_bayar ?: 0 ;

        $this->openModal(['objekPajak' => $this->objekPajak]);
        $this->resetInput();
    }

    public function submit()
    {
        $validatedData = Validator::make($this->state, [
            'wajib_pajak_id' => 'required',
            'objek_pajak_id' => 'required',
            'metode_bayar' => 'required',
            'tahun' => 'required',
            'bulan' => 'required',
            'nilai_pajak' => 'required',
            'jumlah_bayar' => 'required',
            'sisa' => 'required',
            'status_bayar' => 'required',
        ])->validate();

        if (is_null($this->state['bulan'])) {
            $this->state['bulan'] = now()->month;
        }


        $nomorSkpd = Helper::generateNomorSkpd($this->objekPajak->id_jenis_op, $this->objekPajak->id, $this->state['bulan'], $this->state['tahun']) ?: null;
        $nomorSts = Helper::generateNomorSts($this->objekPajak->id_jenis_op, $this->objekPajak->id_jenis_op) ?: null;

        $tgl = Carbon::createFromDate($this->state['tahun'], (int) $this->state['bulan'], now()->day)->addMonths(1)->format('Y-m-d');
        $tglJatuhTempo = $this->state['nilai_pajak'] > 0 ? $tgl : null;
        $tglBayar = $this->state['status_bayar'] === '1' ? now() : null;

        $pembayaran = $this->objekPajak->pembayaran()->where('tahun', $this->state['tahun'])->where('bulan', $this->state['bulan'])
            ->where('wajib_pajak_id', $this->objekPajak->id_wp)
            ->where('objek_pajak_id', $this->objekPajak->id)
            ->orderBy('tahun', 'DESC')
            ->orderBy('bulan', 'DESC')
            ->get()->first();

        if(!is_null($pembayaran)){
            $tglJatuhTempo = $this->state['nilai_pajak'] > 0 ? $pembayaran->jatuh_tempo : $tgl;
        }

        $validatedData['nomor_skpd'] = $nomorSkpd;
        $validatedData['nomor_sts'] = $nomorSts;
        $validatedData['tgl_bayar'] = $tglBayar;
        $validatedData['jatuh_tempo'] = $tglJatuhTempo;
        $validatedData['jumlah_bayar'] = (double) $this->state['jumlah_bayar'];
        $validatedData['nilai_pajak_sebelumnya'] = (null === $pembayaran) ? $this->nilai_pajak : $pembayaran->nilai_pajak_sebelumnya;
        $validatedData['status_transaksi'] = (null === $pembayaran) ? 1 : $pembayaran->status_transaksi;
        $validatedData['keterangan'] = (null === $pembayaran) ? $this->keterangan : '';

//        $values = [
//            'wajib_pajak_id'         => (null === $pembayaran) ? $this->objekPajak->id_wp : $pembayaran->wajib_pajak_id,
//            'objek_pajak_id'         => (null === $pembayaran) ? $this->objekPajak->id : $pembayaran->objek_pajak_id,
//            'metode_bayar'           => (null === $pembayaran) ? $this->metode_bayar : $pembayaran->metode_bayar,
//            'nomor_skpd'             => $nomorSkpd,
//            'nomor_sts'              => $nomorSts,
//            'tahun'                  => (null === $pembayaran) ? $this->tahun : $pembayaran->tahun,
//            'bulan'                  => (null === $pembayaran) ? $this->bulan : $pembayaran->bulan,
//            'tgl_bayar'              => $tglBayar,
//            'jatuh_tempo'            => $tglJatuhTempo,
//            'jumlah_bayar'           => (null === $pembayaran) ? $this->jumlah_bayar : $pembayaran->jumlah_bayar,
//            'nilai_pajak'            => (null === $pembayaran) ?$this->nilai_pajak : $pembayaran->nilai_pajak,
//            'nilai_pajak_sebelumnya' => (null === $pembayaran) ? $this->nilai_pajak : $pembayaran->nilai_pajak_sebelumnya,
//            'sisa'                   => (null === $pembayaran) ? $this->sisa : 0,
//            'status_bayar'           => (null === $pembayaran) ? $this->status_bayar : 0,
//            'status_transaksi'       => (null === $pembayaran) ? 1 : $pembayaran->status_transaksi,
//            'keterangan'             => (null === $pembayaran) ? $this->keterangan : '',
//        ];
//
//        dd($validatedData, $values);

        $bulan = (string) now()->month;

        if (null !== $pembayaran) {
            $bulan = (string) $pembayaran->bulan;
        }
//
        if ((string) $this->state['bulan'] === $bulan && !is_null($pembayaran)) {
            $noTransaksi = $pembayaran->no_transaksi;
            $trx = ['no_transaksi' => $noTransaksi];
            unset($validatedData['status_transaksi'],$validatedData['jatuh_tempo'],$validatedData['nomor_sts'],$validatedData['nomor_skpd']);
            $create = $pembayaran->update($validatedData + $trx);
            $message = 'diperbaharui';
        } else {
            $noTransaksi = Helper::generateNoTransaksi();
            $trx = ['no_transaksi' => $noTransaksi];
            $create = Pembayaran::create($validatedData + $trx);
            $message = 'ditambahkan';
        }

        if ($create) {
            $this->alert([
                'success' => true,
                'message' => 'Pembayaran objek pajak berhasil '.$message,
            ]);
            $this->closeModal();
            $this->resetInput();
            $this->redirectRoute('pembayaran.reklame.detail', $this->objekPajak->id);
        } else {
            $this->alert([
                'success' => false,
                'message' => 'Pembayaran objek pajak gagal '.$message,
            ]);
            $this->closeModal();
            $this->resetInput();
        }
    }

    public function updateNilaiPajak($id, $value)
    {
        $objekPajak = $this->objekPajak->with(['wajibpajak', 'jenisObjekPajak', 'pembayaran'])
            ->where('id_jenis_op', $this->objekPajakId)
            ->find($id);

        $pembayaran = $objekPajak->pembayaran()->get()->first();

        if (optional($pembayaran->update(['nilai_pajak' => (double) $value]))) {
            $this->dispatchBrowserEvent('alert', [
                'success' => true,
                'message' => 'Nilai Pajak berhasil di tambahkan',
            ]);
        } else {
            $this->dispatchBrowserEvent('alert', [
                'success' => false,
                'message' => 'Nilai Pajak gagal di tambahkan',
            ]);
        }
    }

    public function updatedStateJumlahBayar($value)
    {
        $value = (double) $value;
        if($value > $this->state['nilai_pajak']){
            $sisa = $value - $this->state['nilai_pajak'];
        }elseif($value < $this->state['nilai_pajak']){
            $sisa = '-'. $this->state['nilai_pajak'] - $value;
        }else{
            $sisa = 0;
        }
        $this->state['sisa'] = number_format($sisa,0,',','.');
    }

    public function render()
    {
        $listPembayaran = $this->objekPajak->with(['wajibpajak', 'pembayaran'])
            ->search(trim($this->search))
            ->when($this->selectedStatus, function ($q) {
                $q->whereHas('pembayaran', function ($q) {
                    $q->where('status_bayar', $this->selectedStatus);
                });
            })
            ->when($this->selectedTahun, function ($q) {
                $q->whereHas('pembayaran', function ($q) {
                    $q->where('tahun', $this->selectedTahun);
                });
            })
            ->when($this->selectedBulan, function ($q) {
                $q->whereHas('pembayaran', function ($q) {
                    $q->where('bulan', $this->selectedBulan);
                });
            })
            ->where('id_jenis_op', $this->objekPajakId)
            ->orderBy($this->defaultSort)
            ->groupBy('id_wp')
            ->paginate($this->perPage);

        $listBulan = config('custom.bulan');
        $listJenisReklame = JenisReklame::pluck('nama_jenis_op','id');
        $statusBayar = config('custom.status_bayar');
        $listMetodeBayar = MetodeBayarPajak::pluck('jenis_metode','id');

        return view('livewire.transaksi-pajak.pembayaran.reklame.table',compact('listMetodeBayar',
            'listPembayaran','listJenisReklame','statusBayar','listBulan'
        ));
    }
}
