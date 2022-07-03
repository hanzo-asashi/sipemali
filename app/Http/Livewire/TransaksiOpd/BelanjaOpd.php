<?php

namespace App\Http\Livewire\TransaksiOpd;

use App\Models\AnggaranOpd;
use App\Models\BelanjaOpd as Model;
use App\Models\DaftarOpd;
use App\Models\ObjekPajak;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class BelanjaOpd extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $belanjaOpd;
    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'id';
    public int $perPage = 10;
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    public bool $showEditModal = false;
    public $selectedObjekPajak = '';
    public $selectedOpd = '';
    public $listObjekPajak;
    public $idJenisOp;

    public $anggaran_opd_id;
    public $opd_id;
    public $objek_pajak_id;
    public $objek_pajak;
    public $nama_opd;
    public $jenis_belanja;
    public $jumlah_transaksi;
    public $jumlah_pajak;
    public $bulan;
    public $tahun;
//    public $periode;

    public $listeners = [];
    protected string $paginationTheme = 'bootstrap';

    protected $rules
        = [
            'objek_pajak_id'   => 'required',
            'opd_id'           => 'required',
            'jenis_belanja'    => 'required',
            'jumlah_transaksi' => 'required',
            'jumlah_pajak'     => 'required',
            'bulan'            => 'required',
            'tahun'            => 'required|date_format:Y',
            //            'periode'          => 'date',
        ];

    protected $validationAttributes
        = [
            'opd_id'         => 'opd',
            'objek_pajak_id' => 'objek pajak',
        ];
    public int $belanja_opd_id;

    public function mount()
    {
//        $this->periode = now()->format('Y-m-d');
        $this->tahun = setting('tahun_sppt');
        $this->bulan = setting('masa_pajak_bulan');

//        $this->idJenisOp = collect();
        if (!is_null($this->jenis_belanja)) {
            $this->listObjekPajak = ObjekPajak::where('id_jenis_op', $this->objek_pajak_id)->get();
        } else {
            $this->listObjekPajak = collect();
        }

    }

    public function updatedJenisBelanja($value)
    {
        if (!is_null($value)) {
            $this->listObjekPajak = ObjekPajak::where('id_jenis_op', (int) $value)->get();
        }

        $this->objek_pajak_id = $value;
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function add()
    {
        $this->showEditModal = false;
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->reset('opd_id', 'objek_pajak_id', 'jenis_belanja', 'jumlah_pajak', 'jumlah_transaksi');
    }

    public function edit(Model $belanjaOpd)
    {
        $this->showEditModal = true;
        $this->belanja_opd_id = $belanjaOpd->id;
        $this->opd_id = $belanjaOpd->opd_id;
        $this->objek_pajak_id = $belanjaOpd->objek_pajak_id;
        $this->jenis_belanja = $belanjaOpd->jenis_belanja;
        $this->listObjekPajak = ObjekPajak::where('id_jenis_op', $this->objek_pajak_id)->get();
        $this->jumlah_transaksi = $belanjaOpd->jumlah_transaksi;
        $this->jumlah_pajak = $belanjaOpd->jumlah_pajak;
        $this->bulan = $belanjaOpd->bulan;
        $this->tahun = $belanjaOpd->tahun;
//        $this->periode = $belanjaOpd->periode;
        $this->belanjaOpd = $belanjaOpd;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedJumlahTransaksi()
    {
        $this->jumlah_pajak = ($this->jumlah_transaksi * 10) / 100;
    }

    public function updatedObjekPajakId($val)
    {
        if (is_array($val)) {
            $this->objek_pajak_id = $val['value'];
        } else {
            $this->objek_pajak_id = (int) $val;
        }
    }

    public function createBelanjaOpd()
    {
        $data = ['success' => 'false', 'message' => 'Belanja OPD gagal di tambahkan'];
        $validatedData = $this->validate();
        $validatedData['periode'] = Carbon::create($this->tahun, $this->bulan, now()->day);

        // save belanja OPD
        $create = Model::create($validatedData);

        // Jika berhasil disimpan update realisasi anggaran opd
        if ($create) {
            $qry = Model::query()->where('opd_id', $create->opd_id)->where('tahun', $create->tahun);
            $totalTransaksi = $qry->get()->sum('jumlah_transaksi');
            $update = [
                'realisasi' => $totalTransaksi,
            ];

            if ((int) $this->jenis_belanja === 1) {
                $jumlahTransaksi = $qry->where('jenis_belanja', 1)->get()->sum('jumlah_transaksi');
                $update['realisasi_rm'] = (double) $jumlahTransaksi;
            } else {
                $jumlahTransaksi = $qry->where('jenis_belanja', 2)->get()->sum('jumlah_transaksi');
                $update['realisasi_htl'] = (double) $jumlahTransaksi;
            }

            $anggaran = AnggaranOpd::where('opd_id', $create->opd_id)->update($update);

            if ($anggaran) {
                $data['success'] = true;
                $data['message'] = 'Belanja OPD berhasil disimpan';
            } else {
                $data['success'] = false;
                $data['message'] = 'Belanja OPD gagal disimpan';
            }
        } else {
            $data['success'] = false;
            $data['message'] = 'Belanja OPD gagal ditambahkan';
        }
        $this->resetInput();
        $this->alert($data);
    }

    private function alert($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('alert', $options);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateBelanjaOpd()
    {
        $data = ['success' => false, 'message' => 'Belanja OPD gagal di perbaharui'];
        $validatedData = $this->validate([
            'objek_pajak_id'   => 'required',
            'opd_id'           => 'required',
            'jenis_belanja'    => 'required',
            'jumlah_transaksi' => 'required',
            'jumlah_pajak'     => 'required',
            'bulan'            => 'required',
            'tahun'            => 'required|date_format:Y',
        ]);
        $validatedData['periode'] = Carbon::create($this->tahun, $this->bulan, now()->day);
        $update = $this->belanjaOpd->update($validatedData);

        if ($update) {
            $qry = Model::where('opd_id', $this->opd_id)->where('tahun', setting('tahun_sppt'))->find($this->belanja_opd_id);
            $update = [
                'realisasi' => $qry->sum('jumlah_transaksi'),
            ];

            if ($qry->jenis_belanja === 1) {
                $update['realisasi_rm'] = $qry->sum('jumlah_transaksi');
            } else {
                $update['realisasi_htl'] = $qry->sum('jumlah_transaksi');
            }

            $anggaran = AnggaranOpd::where('opd_id', $qry->opd_id)
                ->update($update);

            if ($anggaran) {
                $data['success'] = true;
                $data['message'] = 'Belanja OPD berhasil ditambahkan';
            } else {
                $data['success'] = false;
                $data['message'] = 'Belanja OPD gagal ditambahkan';
            }

            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Belanja OPD berhasil di perbaharui';
            $this->showEditModal = false;
        }

        $this->alert($data);
    }

    public function delete($id, $tipe): ?bool
    {
//    $this->authorize('delete', $this->checked);
        if ($tipe === 'bulk') {
            $user = Model::whereKey($this->checked)->delete();
            $this->checked = [];
            session()->flash('message', 'Jenis Wajib Pajak berhasil dihapus.');

            return $user;
        } else {
            session()->flash('message', 'Jenis Wajib Pajak berhasil dihapus.');

            return Model::findOrFail($id)->delete();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = Model::query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function isChecked($userid): bool
    {
        return in_array($userid, $this->checked);
    }

    public function render()
    {
        $listBelanjaOpd = Model::with(['opd', 'objekPajak'])
            ->search(trim($this->search))
            ->when($this->selectedOpd, function ($q) {
                $q->whereHas('opd', function ($q) {
                    $q->where('id', $this->selectedOpd);
                });
            })
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);
        $listOpd = DaftarOpd::pluck('nama_opd', 'id');
        $listJenisBelanja = [1 => 'Rumah Makan', 2 => 'Hotel'];
        $listBulan = config('custom.bulan');

        return view('livewire.transaksi-opd.belanja-opd',
            compact('listBelanjaOpd', 'listOpd', 'listJenisBelanja', 'listBulan'));
    }
}
