<?php

namespace App\Http\Livewire\TransaksiOpd;

use App\Models\AnggaranOpd as Model;
use App\Models\DaftarOpd;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class AnggaranOpd extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $anggaranOpd;
    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'opd_id';
    public int $perPage = 10;
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public string $cardTitle = 'List Anggaran OPD';
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    public bool $showEditModal = false;
    public $selectedOpd = '';
    public $selectedTahun = '';

    public $opd_id;
    public $nama_opd;
    public $nilai_pagu;
    public $jenis_anggaran;
    public $nilai_pagu_htl;
    public $nilai_pagu_rm;
    public $target_pajak;
    public $target_pajak_rm;
    public $target_pajak_htl;
    public $realisasi;
    public $realisasi_rm;
    public $realisasi_htl;
    public $tahun;
    public $persenTargetPajak;

    public array $listJenisAnggaran
        = [
            1 => 'Makan Minum',
            2 => 'Hotel',
        ];

    public $listeners = [];
    protected string $paginationTheme = 'bootstrap';

    protected $rules
        = [
            'opd_id'         => 'required|unique:anggaran_opds,opd_id',
            'nilai_pagu_rm'  => 'required',
            'nilai_pagu_htl' => 'required',
            'tahun'          => 'required|date_format:Y',
        ];

    protected $validationAttributes
        = [
            'opd_id' => 'opd',
        ];

    public function mount()
    {
        $this->tahun = setting('tahun_sppt');
        $this->persenTargetPajak = setting('persen_target_anggaran', 10);
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
        $this->reset('nama_opd', 'opd_id', 'nilai_pagu_rm', 'nilai_pagu_htl',
            'target_pajak', 'target_pajak_rm', 'target_pajak_htl', 'realisasi', 'realisasi_rm', 'realisasi_htl'
        );
    }

    public function edit(Model $anggaranOpd)
    {
        $this->showEditModal = true;
        $this->opd_id = $anggaranOpd->opd_id;
        $this->nama_opd = $anggaranOpd->nama_opd;
//        $this->jenis_anggaran = $anggaranOpd->jenis_anggaran;
        $this->nilai_pagu_rm = $anggaranOpd->nilai_pagu_rm;
        $this->nilai_pagu_htl = $anggaranOpd->nilai_pagu_htl;
//        $this->target_pajak = $anggaranOpd->target_pajak;
        $this->tahun = $anggaranOpd->tahun;
        $this->anggaranOpd = $anggaranOpd;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createAnggaranOpd()
    {
        $data = ['success' => 'false', 'message' => 'Anggaran OPD gagal di tambahkan'];
        $validatedData = $this->validate();

        $validatedData['nilai_pagu'] = $this->nilai_pagu_rm + $this->nilai_pagu_htl;
        $validatedData['target_pajak_rm'] = ($this->nilai_pagu_rm * $this->persenTargetPajak) / 100;
        $validatedData['target_pajak_htl'] = ($this->nilai_pagu_htl * $this->persenTargetPajak) / 100;
        $validatedData['target_pajak'] = (($this->nilai_pagu_htl + $this->nilai_pagu_rm) * $this->persenTargetPajak) / 100;
        $validatedData['realisasi'] = 0;
        $validatedData['realisasi_rm'] = 0;
        $validatedData['realisasi_htl'] = 0;

        $create = Model::create($validatedData);
        if ($create) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Anggaran OPD berhasil ditambahkan';
        }

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

    public function updateAnggaranOpd()
    {
        $data = ['success' => false, 'message' => 'Anggaran OPD gagal di perbaharui'];
        $validatedData = $this->validate([
            'opd_id'         => 'required',
            'nilai_pagu_rm'  => 'required',
            'nilai_pagu_htl' => 'required',
            'tahun'          => 'date_format:Y',
        ]);

        $validatedData['nilai_pagu'] = $this->nilai_pagu_rm + $this->nilai_pagu_htl;
        $validatedData['target_pajak_rm'] = ($this->nilai_pagu_rm * $this->persenTargetPajak) / 100;
        $validatedData['target_pajak_htl'] = ($this->nilai_pagu_htl * $this->persenTargetPajak) / 100;
        $validatedData['target_pajak'] = (($this->nilai_pagu_htl + $this->nilai_pagu_rm) * $this->persenTargetPajak) / 100;

        $update = $this->anggaranOpd->update($validatedData);

        if ($update) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Anggaran OPD berhasil di perbaharui';
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
            session()->flash('message', 'Anggaran OPD berhasil dihapus.');

            return $user;
        } else {
            session()->flash('message', 'Anggaran OPD berhasil dihapus.');

            return Model::findOrFail($id)->delete();
        }
    }


    public function updatedNilaiPaguHtl($val)
    {
        $nilaiHtl = (double) $val;
        $nilaiRm = (double) $this->nilai_pagu_rm;
        $totalPagu = $nilaiHtl + $nilaiRm;
        $pajak = ($totalPagu * 10) / 100;
        $this->target_pajak = $totalPagu + $pajak;
        $this->target_pajak_rm = ($nilaiRm * 10) / 100;
        $this->target_pajak_htl = ($nilaiHtl * 10) / 100;
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
        $listAnggaranOpd = Model::with(['opd'])->search(trim($this->search))
            ->when($this->selectedTahun, function ($q) {
                $q->where('tahun', $this->selectedTahun);
            })
            ->when($this->selectedOpd, function ($q) {
                $q->whereHas('opd', function ($q) {
                    $q->where('id', $this->selectedOpd);
                });
            })
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);
        $listOpd = DaftarOpd::pluck('nama_opd', 'id');
        $listTahun = config('custom.tahun_kontrak');

        return view('livewire.transaksi-opd.anggaran-opd', compact('listAnggaranOpd', 'listOpd', 'listTahun'));
    }

}
