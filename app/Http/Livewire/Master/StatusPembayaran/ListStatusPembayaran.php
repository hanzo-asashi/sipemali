<?php

namespace App\Http\Livewire\Master\StatusPembayaran;

use App\Models\PaymentStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ListStatusPembayaran extends Component
{
    use WithPagination;
    use LivewireAlert;

    public PaymentStatus $paymentStatus;

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

    public $paymentStatusId;

    public $deleteTipe;

    public string $title = 'List Status Pembayaran';

    public bool $show = true;

    public string $modalId = 'modal-statusbayar';

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

    public function mount(PaymentStatus $paymentStatus): void
    {
        $this->perPage = config('custom.page_count', 15);
        $this->paymentStatus = $paymentStatus;
    }

    public function isChecked($id): bool
    {
        return in_array($id, $this->checked, true);
    }

    public function selectAllData(): void
    {
        $this->selectAllStatus = true;
        $this->checked = $this->paymentStatus->pluck('id')->toArray();
    }

    public function updatedSelectAllCheckbox($value): void
    {
        if ($value) {
            $this->checked = $this->paymentStatus->query()
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
        $this->reset('state');
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
        $status = $this->paymentStatus->find($id);
        $this->paymentStatusId = $id ?? $status->id;
        $this->state['name'] = $status->name;
        $this->state['shortcode'] = $status->shortcode;
    }

    public function addStatus(): void
    {
        $this->updateMode = false;
        $this->resetField();
    }

    public function storeStatus(): void
    {
        $validated = Validator::make($this->state, [
            'name' => 'required|max:50',
            'shortcode' => 'nullable|max:5',
        ])->validate();

        $create = $this->paymentStatus->create($validated);
        $this->sendNotifikasi($create);
        $this->resetField();
    }

    public function updateStatus(): void
    {
        $validated = Validator::make($this->state, [
            'name' => 'required|max:50',
            'shortcode' => 'nullable|max:5',
        ])->validate();

        $update = $this->paymentStatus->find($this->paymentStatusId);

        $update->update($validated);
        $this->sendNotifikasi($update);
        $this->resetField();
    }

    public function confirmedDelete(): void
    {
        $this->delete($this->paymentStatusId, $this->deleteTipe);
    }

    public function destroy($id, $tipe): void
    {
        $this->paymentStatusId = $id;
        $this->deleteTipe = $tipe;

        $this->confirm('Anda yakin ingin menghapus ??', [
            'onConfirmed' => 'confirmedDelete',
        ]);
    }

    public function delete($id, $tipe): void
    {
        if ('bulk' === $tipe) {
            $delete = $this->paymentStatus->query()->whereKey($this->checked)->delete();
            $this->checked = [];
        } else {
            $delete = $this->paymentStatus->findOrFail($id)->delete();
        }
        $this->sendNotifikasi($delete);
    }

    private function sendNotifikasi($model): void
    {
        if ($model) {
            $this->alert('success', 'Status Pembayaran berhasil disimpan atau diperbarui');
        } else {
            $this->alert('danger', 'Status Pembayaran gagal disimpan atau diperbarui');
        }
    }

    public function render(): Factory|View|Application
    {
        $listStatus = $this->paymentStatus
            ->orderBy($this->orderBy, $this->direction)
            ->paginate($this->perPage);

        $this->pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listStatus->total(),
        ];

        return view('livewire.master.status-pembayaran.list-status-pembayaran', compact('listStatus'));
    }
}
