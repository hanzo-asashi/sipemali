<?php

namespace App\Http\Livewire\Master\JenisBahanbakuMineral;

use App\Models\JenisBahanBakuMineral;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public $jenisBahanBaku;
    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'nama';
    public int $perPage = 10;
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    public bool $showEditModal = false;

    public $nama;
    public $satuan;
    public $nilai;
    public $listeners = [];

    protected function rules()
    {
        return [
            'nama'      => 'required|unique:jenis_bahanbaku_mineral,nama',
            'satuan'    => 'required',
            'nilai'     => 'required|integer',
        ];
    }

    public function add()
    {
        $this->showEditModal = false;
        $this->resetInput();
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function edit(JenisBahanBakuMineral $jenisBahanBaku)
    {
        $this->showEditModal = true;
        $this->nama = $jenisBahanBaku->nama;
        $this->nilai = $jenisBahanBaku->nilai;
        $this->satuan = $jenisBahanBaku->satuan;
        $this->jenisBahanBaku = $jenisBahanBaku;
    }

    private function resetInput()
    {
        $this->reset('nama', 'nilai', 'satuan');
    }

    private function alert($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('alert', $options);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createJenisBahanBakuMineral()
    {
        $data = ['success' => 'false', 'message' => 'Jenis Bahan Baku Mineral gagal di tambahkan'];
        $validatedData = $this->validate([
            'nama'      => 'required',
            'satuan'    => 'required',
            'nilai'     => 'required',
        ]);

        $create = JenisBahanBakuMineral::create($validatedData);
        if ($create) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Jenis Bahan Baku Mineral berhasil ditambahkan';
        }

        $this->alert($data);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateJenisBahanBakuMineral()
    {
        $data = ['success' => false, 'message' => 'Jenis Bahan Baku Mineral gagal di perbaharui'];
        $validatedData = $this->validate([
            'nama'      => 'required',
            'satuan'    => 'required',
            'nilai'     => 'required',
        ]);

        $update = $this->jenisBahanBaku->update($validatedData);

        if ($update) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Jenis Bahan Baku Mineral berhasil di perbaharui';
            $this->showEditModal = false;
        }

        $this->alert($data);
    }

    public function delete($id, $tipe): ?bool
    {
//    $this->authorize('delete', $this->checked);
        if ($tipe === 'bulk') {
            $user = JenisBahanBakuMineral::whereKey($this->checked)->delete();
            $this->checked = [];
            session()->flash('message', 'Jenis Bahan Baku Mineral berhasil dihapus.');

            return $user;
        } else {
            session()->flash('message', 'Jenis Bahan Baku Mineral berhasil dihapus.');

            return JenisBahanBakuMineral::findOrFail($id)->delete();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = JenisBahanBakuMineral::query()
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
        $listBahanBaku = JenisBahanBakuMineral::search(trim($this->search))
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);

        return view('livewire.master.jenis-bahanbaku-mineral.table', compact('listBahanBaku'));
    }
}
