<?php

namespace App\Http\Livewire\Master\Loket;

use App\Models\BranchCounter;
use App\Models\Status;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\LoketService;
use App\Services\DataService;

class ListLoket extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected string $paginationTheme = 'bootstrap';

    public BranchCounter $branchCounter;

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
    public bool $selectAllLoket = false;

    public int $loketId;
    public string $deleteTipe = 'single';

    public string $title = 'List Loket';

    protected $listeners = [
        'delete',
        'resetField',
        'confirmedDelete',
    ];

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function mount(BranchCounter $branchCounter): void
    {
        $this->branchCounter = $branchCounter;
    }

    public function isChecked($id): bool
    {
        return in_array($id, $this->checked, true);
    }

    public function selectAllData(): void
    {
        $this->selectAllLoket = true;
        $this->checked = $this->branchCounter->pluck('id')->toArray();
    }

    public function updatedSelectAllCheckbox($value): void
    {
        if ($value) {
            $this->checked = $this->branchCounter->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray()
            ;
        } else {
            $this->checked = [];
            $this->selectAllLoket = false;
        }
    }

    public function resetCheckbox(): void
    {
        $this->checked = [];
        $this->selectAllLoket = false;
        $this->selectAllCheckbox = false;
    }

    public function resetField(): void
    {
        $this->reset('state', 'checked');
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

    public function editLoket($id): void
    {
        $this->updateMode = true;
        $loket = $this->branchCounter->find($id);
        $this->loketId = $id ?? $loket->id;
        $this->state['name'] = $loket->name;
        $this->state['description'] = $loket->description;
        $this->state['branch_code'] = $loket->branch_code;
    }

    public function addLoket(): void
    {
        $this->updateMode = false;
        $this->resetField();
    }

    public function storeLoket(): void
    {
        $validated = Validator::make($this->state, [
            'name' => 'required|max:100',
            'branch_code' => 'required|max:5',
            'description' => 'nullable|max:255',
        ])->validate();

        $create = $this->branchCounter->create($validated);

        $this->sendNotifikasi($create);
        $this->resetField();
    }

    public function updateLoket(): void
    {
        $validated = Validator::make($this->state, [
            'name' => 'required|max:100',
            'description' => 'nullable|max:255',
            'branch_code' => 'required|max:5',
        ])->validate();

        $update = $this->branchCounter->find($this->loketId);
        $update->update($validated);

        $this->sendNotifikasi($update);
        $this->resetField();
    }

    public function confirmedDelete() : void
    {
        $this->delete($this->loketId, $this->deleteTipe);
    }

    public function destroy($id, $tipe): void
    {
        $this->loketId = $id;
        $this->deleteTipe = $tipe;
        $this->confirm('Anda yakin ingin menghapus ??', [
            'onConfirmed' => 'confirmedDelete',
        ]);
    }

    public function delete($id, $tipe): void
    {
        if ('bulk' === $tipe) {
            $delete = $this->branchCounter->query()->whereKey($this->checked)->delete();
            $this->checked = [];
        } else {
            $delete = $this->branchCounter->find($id)->delete();
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

    public function render(): View
    {
        $listLoket = $this->branchCounter
//            ->search($this->search)
            ->orderBy($this->orderBy, $this->direction)
            ->paginate($this->perPage)
        ;

        $this->pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listLoket->total(),
        ];

        return view('livewire.master.loket.list-loket',compact('listLoket'))->extends('layouts.contentLayoutMaster');
    }
}
