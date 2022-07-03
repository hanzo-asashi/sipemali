<?php

namespace App\Http\Livewire\Master\TipeUsahaReklame;

use App\Models\TipeUsahaReklame;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public $tipeUsahaReklame;
    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'nama_tipe_usaha';
    public int $perPage = 10;
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    public bool $showEditModal = false;

    public $nama_tipe_usaha;
    public $listeners = [];

    protected function rules()
    {
        return [
            'nama_tipe_usaha' => 'required|unique:tipe_usaha_reklame,nama_tipe_usaha',
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

    public function edit(TipeUsahaReklame $tipeUsahaReklame)
    {
        $this->showEditModal = true;
        $this->nama_tipe_usaha = $tipeUsahaReklame->nama_tipe_usaha;
        $this->tipeUsahaReklame = $tipeUsahaReklame;
    }

    private function resetInput()
    {
        $this->reset('nama_tipe_usaha');
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

    public function createTipeUsahaReklame()
    {
        $data = ['success' => 'false', 'message' => 'Tipe Usaha Reklame gagal di tambahkan'];
        $validatedData = $this->validate();

        $create = TipeUsahaReklame::create($validatedData);
        if ($create) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Tipe Usaha Reklame berhasil ditambahkan';
        }

        $this->alert($data);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateTipeUsahaReklame()
    {
        $data = ['success' => false, 'message' => 'Tipe Usaha Reklame gagal di perbaharui'];
        $validatedData = $this->validate([
            'nama_tipe_usaha' => 'required',
        ]);

        $update = $this->tipeUsahaReklame->update($validatedData);

        if ($update) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Tipe Usaha Reklame berhasil di perbaharui';
            $this->showEditModal = false;
        }

        $this->alert($data);
    }

    public function delete($id, $tipe): ?bool
    {
//    $this->authorize('delete', $this->checked);
        if ($tipe === 'bulk') {
            $user = TipeUsahaReklame::whereKey($this->checked)->delete();
            $this->checked = [];
            session()->flash('message', 'Tipe Usaha Reklame berhasil dihapus.');

            return $user;
        } else {
            session()->flash('message', 'Tipe Usaha Reklame berhasil dihapus.');

            return TipeUsahaReklame::findOrFail($id)->delete();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = TipeUsahaReklame::query()
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
        $listTipeUsaha = TipeUsahaReklame::search(trim($this->search))
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);

        return view('livewire.master.tipe-usaha-reklame.table', compact('listTipeUsaha'));
    }
}
