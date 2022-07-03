<?php

namespace App\Http\Livewire\Master\TipeSatuan;

use App\Models\TipeSatuan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public $tipeSatuan;
    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'satuan';
    public int $perPage = 10;
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    public bool $showEditModal = false;

    public $satuan;
    public $listeners = [];

    protected function rules()
    {
        return [
            'satuan' => 'required|unique:tipe_satuan,satuan',
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

    public function edit(TipeSatuan $tipeSatuan)
    {
        $this->showEditModal = true;
        $this->satuan = $tipeSatuan->satuan;
        $this->tipeSatuan = $tipeSatuan;
    }

    private function resetInput()
    {
        $this->reset('satuan');
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

    public function createTipeSatuan()
    {
        $data = ['success' => 'false', 'message' => 'Tipe Satuan gagal di tambahkan'];
        $validatedData = $this->validate();

        $create = TipeSatuan::create($validatedData);
        if ($create) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Tipe Satuan berhasil ditambahkan';
        }

        $this->alert($data);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateTipeSatuan()
    {
        $data = ['success' => false, 'message' => 'Tipe Satuan gagal di perbaharui'];
        $validatedData = $this->validate([
            'satuan' => 'required',
        ]);

        $update = $this->tipeSatuan->update($validatedData);

        if ($update) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Tipe Satuan berhasil di perbaharui';
            $this->showEditModal = false;
        }

        $this->alert($data);
    }

    public function delete($id, $tipe): ?bool
    {
//    $this->authorize('delete', $this->checked);
        if ($tipe === 'bulk') {
            $user = TipeSatuan::whereKey($this->checked)->delete();
            $this->checked = [];
            session()->flash('message', 'Tipe Satuan berhasil dihapus.');

            return $user;
        } else {
            session()->flash('message', 'Tipe Satuan berhasil dihapus.');

            return TipeSatuan::findOrFail($id)->delete();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = TipeSatuan::query()
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
        $listTipeSatuan = TipeSatuan::search(trim($this->search))
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);

        return view('livewire.master.tipe-satuan.table',compact('listTipeSatuan'));
    }
}
