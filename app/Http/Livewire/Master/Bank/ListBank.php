<?php

namespace App\Http\Livewire\Master\Bank;

use App\Models\BankAccount;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ListBank extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected string $paginationTheme = 'bootstrap';

    public BankAccount $bankAccount;

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

    public bool $selectAllBank = false;

    public int $bankId;

    public string $deleteTipe = 'single';

    public string $title = 'List Bank';

    public bool $show = true;

    public string $modalId = 'modal-bank';

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

    public function mount(BankAccount $bankAccount): void
    {
        $this->bankAccount = $bankAccount;
    }

    public function isChecked($id): bool
    {
        return in_array($id, $this->checked, true);
    }

    public function selectAllData(): void
    {
        $this->selectAllBank = true;
        $this->checked = $this->bankAccount->pluck('id')->toArray();
    }

    public function updatedSelectAllCheckbox($value): void
    {
        if ($value) {
            $this->checked = $this->bankAccount->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
            $this->selectAllBank = false;
        }
    }

    public function resetCheckbox(): void
    {
        $this->checked = [];
        $this->selectAllBank = false;
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

    public function editBank($id): void
    {
        $this->updateMode = true;
        $bank = $this->bankAccount->find($id);
        $this->bankId = $id ?? $bank->id;
        $this->state['name'] = $bank->name;
        $this->state['account_number'] = $bank->account_number;
        $this->state['bank_name'] = $bank->bank_name;
    }

    public function addBank(): void
    {
        $this->updateMode = false;
        $this->resetField();
    }

    public function storeBank(): void
    {
        $validated = Validator::make($this->state, [
            'name' => 'required|max:100',
            'account_number' => 'required|max:20',
            'bank_name' => 'required|max:100',
        ])->validate();

        $create = $this->bankAccount->create($validated);
        $this->sendNotifikasi($create);
        $this->resetField();
    }

    public function updateBank(): void
    {
        $validated = Validator::make($this->state, [
            'name' => 'required|max:100',
            'account_number' => 'nullable|max:20',
            'bank_name' => 'nullable|max:100',
        ])->validate();

        $update = $this->bankAccount->find($this->bankId);

        $update->update($validated);
        $this->sendNotifikasi($update);
        $this->resetField();
    }

    public function confirmedDelete(): void
    {
        $this->delete($this->bankId, $this->deleteTipe);
    }

    public function destroy($id, $tipe): void
    {
        $this->bankId = $id;
        $this->deleteTipe = $tipe;

        $this->confirm('Anda yakin ingin menghapus ??', [
            'onConfirmed' => 'confirmedDelete',
        ]);
    }

    public function delete($id, $tipe): void
    {
        if ('bulk' === $tipe) {
            $delete = $this->bankAccount->query()->whereKey($this->checked)->delete();
            $this->checked = [];
        } else {
            $delete = $this->bankAccount->find($id)->delete();
        }
        $this->sendNotifikasi($delete);
    }

    private function sendNotifikasi($model): void
    {
        if ($model) {
            $this->alert('success', 'Bank berhasil disimpan atau diperbarui');
        } else {
            $this->alert('danger', 'Bank gagal disimpan atau diperbarui');
        }
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $listBank = $this->bankAccount->query()
//            ->search($this->search)
            ->orderBy($this->orderBy, $this->direction)
            ->paginate($this->perPage);

        $this->pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listBank->total(),
        ];

        return view('livewire.master.bank.list-bank', compact('listBank'))->extends('layouts.contentLayoutMaster');
    }
}
