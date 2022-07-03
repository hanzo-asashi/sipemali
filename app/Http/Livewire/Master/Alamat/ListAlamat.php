<?php

namespace App\Http\Livewire\Master\Alamat;

use App\Models\Address;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ListAlamat extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    use LivewireAlert;

    public Address $address;

    public string $search = '';
    public int $perPage = 15;
    public string $orderBy = 'id';
    public string $direction = 'asc';
    public string $defaultSortBy = 'id';

    public array $pageData = [];
    public array $checked = [];
    public array $state = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $updateMode = false;
    public bool $selectAllAlamat = false;

    public $alamat;
    public $alamatId;
    public $deleteTipe;

    public string $title = 'List Alamat';
    public bool $show = false;
    public string $modalId = 'modal-alamat';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'delete',
        'resetField' => 'resetField',
        'confirmedDelete',
    ];

    protected $rules = [
        'alamat' => 'required|max:255',
    ];

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function mount(Address $address)
    {
        $this->address = $address;
    }

    public function isChecked($id): bool
    {
        return in_array($id, $this->checked);
    }

    public function selectAllData()
    {
        $this->selectAllAlamat = true;
        $this->checked = $this->address->pluck('id')->toArray();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = $this->address->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
            $this->selectAllAlamat = false;
        }
    }

    public function resetCheckbox()
    {
        $this->checked = [];
        $this->selectAllAlamat = false;
        $this->selectAll = false;
    }

    public function resetField()
    {
        $this->reset('search', 'alamat', 'checked');
        $this->resetErrorBag();
        $this->updateMode = !$this->updateMode;
    }

    public function updating()
    {
        $this->resetPage();
    }

    public function updatedPerPage($value)
    {
        $this->setPerPage($value);
    }

    public function setPerPage($value)
    {
        $this->perPage = $value;
    }

    public function editAlamat($id)
    {
        $address = $this->address->find($id);
        $this->alamatId = $address->id ?? $id;
        $this->alamat = $address->alamat;
        $this->updateMode = true;
    }

    public function addAlamat()
    {
        $this->updateMode = false;
        $this->resetField();
    }

    public function storeAlamat()
    {
        $validated = $this->validate();

        $create = $this->address->create($validated);
        $this->sendNotifikasi($create);
        $this->resetField();
    }

    public function updateAlamat(): void
    {
        $validated = $this->validate();

        $update = $this->address->findOrFail($this->alamatId);
        $update->update($validated);
        $this->sendNotifikasi($update);
        $this->resetField();
    }

    public function confirmedDelete()
    {
        $this->delete($this->alamatId, $this->deleteTipe);
    }

    public function destroy($id, $tipe)
    {
        $this->alamatId = $id;
        $this->deleteTipe = $tipe;

        $this->confirm('Anda yakin ingin menghapus ??', [
            'onConfirmed' => 'confirmedDelete',
        ]);
    }

    public function delete($id, $tipe)
    {
        if ('bulk' === $tipe) {
            $delete = $this->address->query()->whereKey($this->checked)->delete();
            $this->checked = [];
        } else {
            $delete = $this->address->findOrFail($id)->delete();
        }
        $this->sendNotifikasi($delete, 'sendNotif');
    }

    public function render()
    {
        $listAlamat = $this->address
            ->search($this->search)
            ->orderBy($this->orderBy, $this->direction)
            ->paginate($this->perPage);

        $this->pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listAlamat->total(),
        ];

        return view('livewire.master.alamat.list-alamat', compact('listAlamat'))->extends('layouts.contentLayoutMaster');
    }

    private function sendNotifikasi($model, $event = 'notifikasi')
    {
        if ($model) {
            $this->alert('success', 'Alamat berhasil disimpan atau diperbarui');
        } else {
            $this->alert('danger', 'Alamat gagal disimpan atau diperbarui');
        }
    }
}
