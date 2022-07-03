<?php

namespace App\Http\Livewire\Master\DataOpd;

use App\Models\DaftarOpd;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public $daftarOpd;
    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'nama_opd';
    public int $perPage = 10;
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    public bool $showEditModal = false;

    public $nama_opd;
    public $listeners = [];

    protected function rules()
    {
        return [
            'nama_opd' => 'required|unique:daftar_opd,nama_opd',
        ];
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

    public function edit(DaftarOpd $daftarOpd)
    {
        $this->showEditModal = true;
        $this->nama_opd = $daftarOpd->nama_opd;
        $this->daftarOpd = $daftarOpd;
    }

    private function resetInput()
    {
        $this->reset('nama_opd');
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

    public function createDaftarOpd()
    {
        $data = ['success' => false, 'message' => 'Daftar OPD gagal di tambahkan'];
        $validatedData = $this->validate();

        $create = DaftarOpd::create($validatedData);
        if ($create) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Daftar OPD berhasil ditambahkan';
        }

        $this->alert($data);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateDaftarOpd()
    {
        $data = ['success' => false, 'message' => 'Daftar OPD gagal di perbaharui'];
        $validatedData = $this->validate([
            'nama_opd' => 'required',
        ]);

        $update = $this->daftarOpd->update($validatedData);

        if ($update) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Daftar OPD berhasil di perbaharui';
            $this->showEditModal = false;
        }

        $this->alert($data);
    }

    public function delete($id, $tipe): ?bool
    {
//    $this->authorize('delete', $this->checked);
        if ($tipe === 'bulk') {
            $user = DaftarOpd::whereKey($this->checked)->delete();
            $this->checked = [];
            session()->flash('message', 'Jenis Wajib Pajak berhasil dihapus.');

            return $user;
        } else {
            session()->flash('message', 'Jenis Wajib Pajak berhasil dihapus.');

            return DaftarOpd::findOrFail($id)->delete();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = DaftarOpd::query()
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
        $listOpd = DaftarOpd::search(trim($this->search))
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);

        return view('livewire.master.data-opd.table', compact('listOpd'));
    }
}
