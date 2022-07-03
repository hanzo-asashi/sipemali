<?php

namespace App\Http\Livewire\TransaksiPajak\Pembayaran\Hotel;

use App\Models\MetodeBayarPajak;
use App\Models\ObjekPajak;
use App\Models\Pembayaran;
use App\Models\WajibPajak;
use App\Utilities\Helper;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'id';
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
        $this->dispatchBrowserEvent('notifikasi', $options);
    }


    public function deleteHotel($id, $tipe): ?bool
    {
//    $this->authorize('delete', $this->checked);
        if ($tipe === 'bulk') {
            $pembayaran = $this->objekPajak->whereKey($this->checked)->delete();
            $this->checked = [];

            return $pembayaran;
        } else {
            $objek = $this->objekPajak->findOrFail($id);
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

    public function tambahBayar($opid)
    {
//        $this->showModalBayar = true;
        $this->updateMode = false;
        $this->objekPajak = ObjekPajak::with('pembayaran')->find($opid);
        $pembayaran = $this->objekPajak->pembayaran->first();

        $this->state['no_transaksi'] = Helper::generateNoTransaksi();
        $this->state['wajib_pajak_id'] = $this->objekPajak->id_wp;
        $this->state['objek_pajak_id'] = $this->objekPajak->id;
        $this->state['bulan'] = $this->objekPajak->pembayaran()->get()->first()->bulan ?: setting('masa_pajak_bulan');
        $this->state['tahun'] = setting('tahun_sppt');
        $this->state['metode_bayar'] = 1;
        $this->state['nilai_pajak'] = $pembayaran->nilai_pajak;
        $this->state['status_bayar'] = $pembayaran->status_bayar;
        $this->openModal(['objekPajak' => $this->objekPajak]);
        $this->resetInput();
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

        if (!is_null($pembayaran)) {
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

        $bulan = (string) now()->month;

        if (null !== $pembayaran) {
            $bulan = (string) $pembayaran->bulan;
        }
//
        if ((string) $this->state['bulan'] === $bulan && !is_null($pembayaran)) {
            $noTransaksi = $pembayaran->no_transaksi;
            $trx = ['no_transaksi' => $noTransaksi];
            unset($validatedData['status_transaksi'], $validatedData['jatuh_tempo'], $validatedData['nomor_sts'], $validatedData['nomor_skpd']);
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
            $this->redirectRoute('pembayaran.hotel.detail', $this->objekPajak->id);
        } else {
            $this->alert([
                'success' => false,
                'message' => 'Pembayaran objek pajak gagal '.$message,
            ]);
            $this->closeModal();
            $this->resetInput();
        }
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

    public function render()
    {
        $listPembayaran = $this->objekPajak->select('id', 'id_wp', 'id_jenis_op', 'nopd', 'nama_objek_pajak', 'created_at')
            ->with(['wajibpajak', 'jenisObjekPajak', 'pembayaran'])
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
            ->paginate($this->perPage);

        $listMetodeBayar = MetodeBayarPajak::pluck('jenis_metode', 'id');

        $listBulan = config('custom.bulan');
        $listTahun = config('custom.tahun_kontrak');
        $listStatus = config('custom.status_bayar');

        return view('livewire.transaksi-pajak.pembayaran.hotel.table',
            compact('listPembayaran', 'listBulan', 'listTahun', 'listStatus', 'listMetodeBayar'));
    }
}
