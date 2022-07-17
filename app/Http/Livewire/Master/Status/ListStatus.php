<?php

namespace App\Http\Livewire\Master\Status;

use App\Models\Status;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ListStatus extends Component
{
    use WithPagination;
    use LivewireAlert;

    public Status $status;

    public int $perPage;

    public string $orderBy = 'id';

    public string $direction = 'asc';

    public string $defaultSortBy = 'id';

    public array $pageData = [];

    public array $checked = [];

    public array $state = [];

    public bool $isChecked = false;

    public bool $selectAllCheckbox = false;

    public bool $updateMode = false;

    public bool $selectAllStatus = false;

    public $statusId;

    public $deleteTipe;

    public string $title = 'List Status';

    public bool $show = true;

    public string $modalId = 'modal-status';

    protected string $paginationTheme = 'bootstrap';

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

    public function mount(Status $status): void
    {
        $this->perPage = config('custom.page_count', 15);
        $this->status = $status;
    }

    public function isChecked($id): bool
    {
        return in_array($id, $this->checked, true);
    }

    public function selectAllData(): void
    {
        $this->selectAllStatus = true;
        $this->checked = $this->status->pluck('id')->toArray();
    }

    public function updatedSelectAllCheckbox($value): void
    {
        if ($value) {
            $this->checked = $this->status->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
            $this->selectAllStatus = false;
        }
    }

    public function resetCheckbox(): void
    {
        $this->checked = [];
        $this->selectAllStatus = false;
        $this->selectAllCheckbox = false;
    }

    public function resetField(): void
    {
        $this->reset('state', 'checked');
        $this->resetErrorBag();
        $this->updateMode = ! $this->updateMode;
    }

    public function updating(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage($value): void
    {
        $this->perPage = $value;
    }

    public function editStatus($id): void
    {
        $this->updateMode = true;
        $status = $this->status->find($id);
        $this->statusId = $id ?? $status->id;
        $this->state['nama_status'] = $status->nama_status;
        $this->state['shortcode'] = $status->shortcode;
//        $this->openModal(['status' => $status]);
    }

    public function addStatus(): void
    {
        $this->updateMode = false;
        $this->resetField();
    }

    public function storeStatus(): void
    {
        $validated = Validator::make($this->state, [
            'nama_status' => 'required|max:50',
            'shortcode' => 'nullable|max:5',
        ])->validate();

        $create = $this->status->create($validated);
        $this->sendNotifikasi($create);
        $this->resetField();
    }

    public function updateStatus(): void
    {
        $validated = Validator::make($this->state, [
            'nama_status' => 'required|max:50',
            'shortcode' => 'nullable|max:5',
        ])->validate();

        $update = $this->status->find($this->statusId);

        $update->update($validated);
        $this->sendNotifikasi($update);
        $this->resetField();
//        $this->closeModal();
    }

    public function confirmedDelete(): void
    {
        $this->delete($this->statusId, $this->deleteTipe);
    }

    public function destroy($id, $tipe): void
    {
        $this->statusId = $id;
        $this->deleteTipe = $tipe;

        $this->confirm('Anda yakin ingin menghapus ??', [
            'onConfirmed' => 'confirmedDelete',
        ]);
    }

    public function delete($id, $tipe): void
    {
        if ('bulk' === $tipe) {
            $delete = $this->status->query()->whereKey($this->checked)->delete();
            $this->checked = [];
        } else {
            $delete = $this->status->findOrFail($id)->delete();
        }
        $this->sendNotifikasi($delete);
    }

    public function render(): Factory|View|Application
    {
        $listStatus = $this->status
//            ->search($this->search)
            ->orderBy($this->orderBy, $this->direction)
            ->paginate($this->perPage);

        $this->pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listStatus->total(),
        ];

        return view('livewire.master.status.list-status', compact('listStatus'));
    }

    private function sendNotifikasi($model): void
    {
        if ($model) {
            $this->alert('success', 'Status berhasil disimpan atau diperbarui');
        } else {
            $this->alert('danger', 'Status gagal disimpan atau diperbarui');
        }
    }
}
