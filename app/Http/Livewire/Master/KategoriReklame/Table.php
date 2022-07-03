<?php

namespace App\Http\Livewire\Master\KategoriReklame;

use App\Models\KategoriReklame;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public $kategoriReklame;
    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'nama_kategori';
    public int $perPage = 10;
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    public bool $showEditModal = false;

    public $nama_kategori;
    public $listeners = [];

    protected function rules()
    {
        return [
            'nama_kategori'      => 'required|unique:kategori_reklame,nama_kategori',
        ];
    }

    public function add()
    {
        $this->showEditModal = false;
        $this->resetInput();
    }

    public function edit(KategoriReklame $kategoriReklame)
    {
        $this->showEditModal = true;
        $this->nama_kategori = $kategoriReklame->nama_kategori;
        $this->kategoriReklame = $kategoriReklame;
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function resetInput()
    {
        $this->reset('nama_kategori');
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

    public function createKategoriOpReklame()
    {
        $data = ['success' => false, 'message' => 'Kategori Reklame gagal di tambahkan'];
        $validatedData = $this->validate();

        $create = KategoriReklame::create($validatedData);
        if ($create) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Kategori Reklame berhasil ditambahkan';
        }

        $this->alert($data);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateKategoriOpReklame()
    {
        $data = ['success' => false, 'message' => 'Kategori Reklame gagal di perbaharui'];
        $validatedData = $this->validate([
            'nama_kategori'      => 'required',
        ]);

        $update = $this->kategoriReklame->update($validatedData);

        if ($update) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Kategori Reklame berhasil di perbaharui';
            $this->showEditModal = false;
        }

        $this->alert($data);
    }

    public function delete($id, $tipe): ?bool
    {
//    $this->authorize('delete', $this->checked);
        if ($tipe === 'bulk') {
            $user = KategoriReklame::whereKey($this->checked)->delete();
            $this->checked = [];
            session()->flash('message', 'Kategori Reklame berhasil dihapus.');

            return $user;
        } else {
            session()->flash('message', 'Kategori Reklame berhasil dihapus.');

            return KategoriReklame::findOrFail($id)->delete();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = KategoriReklame::query()
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
        $listKategoriReklame = KategoriReklame::search(trim($this->search))
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);

        return view('livewire.master.kategori-reklame.table', compact('listKategoriReklame'));
    }
}
