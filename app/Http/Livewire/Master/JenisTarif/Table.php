<?php

namespace App\Http\Livewire\Master\JenisTarif;

use App\Models\JenisTarif;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public $jenisTarif;
    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'jenis';
    public int $perPage = 10;
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    public bool $showEditModal = false;

    public $jenis;
    public $nilai;
    public $keterangan;
    public $listeners = [];

    protected function rules()
    {
        return [
            'jenis'      => 'required|unique:jenis_tarif,jenis',
            'nilai'      => 'required',
            'keterangan' => 'max:255',
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

    public function edit(JenisTarif $jenisTarif)
    {
        $this->showEditModal = true;
        $this->jenis = $jenisTarif->jenis;
        $this->nilai = $jenisTarif->nilai;
        $this->keterangan = $jenisTarif->keterangan;
        $this->jenisTarif = $jenisTarif;
    }

    private function resetInput()
    {
        $this->reset('jenis', 'nilai', 'keterangan');
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

    public function createJenisTarif()
    {
        $data = ['success' => false, 'message' => 'Jenis Tarif gagal di tambahkan'];
        $validatedData = $this->validate();

        $create = JenisTarif::create($validatedData);
        if ($create) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Jenis Tarif berhasil ditambahkan';
        }

        $this->alert($data);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateJenisTarif()
    {
        $data = ['success' => false, 'message' => 'Jenis Tarif gagal di perbaharui'];
        $validatedData = $this->validate([
            'jenis'      => 'required',
            'nilai'      => 'required',
            'keterangan' => 'max:255',
        ]);

        $update = $this->jenisTarif->update($validatedData);

        if ($update) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Jenis Tarif berhasil di perbaharui';
            $this->showEditModal = false;
        }

        $this->alert($data);
    }

    public function delete($id, $tipe): ?bool
    {
//    $this->authorize('delete', $this->checked);
        if ($tipe === 'bulk') {
            $user = JenisTarif::whereKey($this->checked)->delete();
            $this->checked = [];
            session()->flash('message', 'Jenis Tarif berhasil dihapus.');

            return $user;
        } else {
            session()->flash('message', 'Jenis Tarif berhasil dihapus.');

            return JenisTarif::findOrFail($id)->delete();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = JenisTarif::query()
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
        $jenisTrf = JenisTarif::search(trim($this->search))
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);

        return view('livewire.master.jenis-tarif.table', compact('jenisTrf'));
    }
}
