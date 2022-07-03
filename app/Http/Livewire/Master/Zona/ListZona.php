<?php

namespace App\Http\Livewire\Master\Zona;

use App\Models\PaymentStatus;
use App\Models\Zone;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ListZona extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected string $paginationTheme = 'bootstrap';

    public Zone $zone;

    public int $perPage = 15;
    public string $orderBy = 'id';
    public string $direction = 'asc';
    public string $defaultSortBy = 'id';

    public array $pageData = [];
    public array $checked = [];
    public array $state = [];
    public bool $isChecked = false;
    public bool $selectAllCheckbox = false;
    public bool $updateMode = false;
    public bool $selectAllZona = false;

    public int $zonaId;
    public string $deleteTipe = 'single';
    public string $title = 'List Zona Wilayah';

    protected $listeners = [
        'delete',
        'resetField',
        'confirmedDelete',
    ];

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function mount(Zone $zone)
    {
        $this->zone = $zone;
    }

    public function isChecked($id): bool
    {
        return in_array($id, $this->checked);
    }

    public function selectAllData()
    {
        $this->selectAllZona = true;
        $this->checked = $this->zone->pluck('id')->toArray();
    }

    public function updatedSelectAllCheckbox($value)
    {
        if ($value) {
            $this->checked = $this->zone->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray()
            ;
        } else {
            $this->checked = [];
            $this->selectAllZona = false;
        }
    }

    public function resetCheckbox()
    {
        $this->checked = [];
        $this->selectAllZona = false;
        $this->selectAllCheckbox = false;
    }

    public function resetField()
    {
        $this->reset('state');
        $this->resetErrorBag();
    }

    public function updating(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage($value): void
    {
        $this->perPage = $value;
    }

    public function editZona($id): void
    {
        $this->updateMode = true;
        $zona = $this->zone->find($id);
        $this->zonaId = $id ?? $zona->id;
        $this->state['wilayah'] = $zona->wilayah;
        $this->state['kode'] = $zona->kode;
    }

    public function addZona(): void
    {
        $this->updateMode = false;
        $this->resetField();
    }

    public function storeZona(): void
    {
        $validated = Validator::make($this->state, [
            'wilayah' => 'required|max:60',
            'kode' => 'nullable|max:30',
        ])->validate();

        $create = $this->zone->create($validated);
        $this->sendNotifikasi($create);
        $this->resetField();
    }

    public function updateZona(): void
    {
        $validated = Validator::make($this->state, [
            'wilayah' => 'required|max:60',
            'kode' => 'nullable|max:30',
        ])->validate();

        $update = $this->zone->find($this->zonaId);

        $update->update($validated);
        $this->sendNotifikasi($update);
        $this->resetField();
    }

    public function confirmedDelete(): void
    {
        $this->delete($this->zonaId, $this->deleteTipe);
    }

    public function destroy($id, $tipe): void
    {
        $this->zonaId = $id;
        $this->deleteTipe = $tipe;

        $this->confirm('Anda yakin ingin menghapus ??', [
            'onConfirmed' => 'confirmedDelete',
        ]);
    }

    public function delete($id, $tipe): void
    {
        if ('bulk' === $tipe) {
            $delete = $this->zone->query()->whereKey($this->checked)->delete();
            $this->checked = [];
        } else {
            $delete = $this->zone->findOrFail($id)->delete();
        }
        $this->sendNotifikasi($delete);
    }

    private function sendNotifikasi($model): void
    {
        if ($model) {
            $this->alert('success', 'Zona berhasil disimpan atau diperbarui');
        } else {
            $this->alert('danger', 'Zona gagal disimpan atau diperbarui');
        }
    }

    public function render()
    {
        $listZona = $this->zone->query()
            ->orderBy($this->orderBy, $this->direction)
            ->paginate($this->perPage)
        ;

        $this->pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listZona->total(),
        ];

        return view('livewire.master.zona.list-zona', compact('listZona'))->extends('layouts.contentLayoutMaster');
    }
}
