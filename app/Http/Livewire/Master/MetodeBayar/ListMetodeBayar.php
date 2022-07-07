<?php

namespace App\Http\Livewire\Master\MetodeBayar;

use App\Models\MetodeBayar;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ListMetodeBayar extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected string $paginationTheme = 'bootstrap';

    public MetodeBayar $metodeBayar;
    public array $state = [];
    public int $metodeId;
    public string $deleteTipe = 'single';

    public string $search = '';
    public int $perPage;
    public string $orderBy = 'id';
    public string $direction = 'asc';
    public string $defaultSortBy = 'id';

    public array $pageData = [];
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $updateMode = false;
    public bool $selectAllMetode = false;
    public string $title = 'List Metode Bayar';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'delete',
        'resetField' => 'resetField',
        'confirmedDelete'
    ];

    public function mount(MetodeBayar $metodeBayar): void
    {
        $this->perPage = config('custom.page_count', 15);

        $this->metodeBayar = $metodeBayar;
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function isChecked($id): bool
    {
        return in_array($id, $this->checked, true);
    }

    public function selectAllData(): void
    {
        $this->selectAllMetode = true;
        $this->checked = $this->metodeBayar->pluck('id')->toArray();
    }

    public function updatedSelectAll($value): void
    {
        if ($value) {
            $this->checked = $this->metodeBayar->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray()
            ;
        } else {
            $this->checked = [];
            $this->selectAllMetode = false;
        }
    }

    public function resetCheckbox(): void
    {
        $this->checked = [];
        $this->selectAllMetode = false;
        $this->selectAll = false;
    }

    public function resetField(): void
    {
        $this->reset('search', 'state', 'checked');
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

    public function editMetode($id): void
    {
        $this->updateMode = true;
        $metode = $this->metodeBayar->find($id);
        $this->metodeId = $metode->id ?? $id;
        $this->state['kode'] = $metode->kode;
        $this->state['nama'] = $metode->nama;
        $this->state['deskripsi'] = $metode->deskripsi;
    }

    public function addMetode(): void
    {
        $this->updateMode = false;
        $this->resetField();
    }

    public function storeMetode(): void
    {
        $validated = \Validator::make($this->state,[
            'kode' => 'required|max:5|unique:metode_bayar,kode',
            'nama' => 'required|max:50',
            'deskripsi' => 'nullable|max:100',
        ] )->validate();

        $create = $this->metodeBayar->create($validated);
        $this->sendNotifikasi($create);
        $this->resetField();
    }

    public function updateMetode(): void
    {
        $validated = \Validator::make($this->state,[
            'kode' => 'required|max:5',
            'nama' => 'required|max:50',
            'deskripsi' => 'nullable|max:100',
        ] )->validate();

        $update = $this->metodeBayar->find($this->metodeId);
        $update->update($validated);
        $this->sendNotifikasi($update);
        $this->resetField();
    }

    public function confirmedDelete(): void
    {
        $this->delete($this->metodeId, $this->deleteTipe);
    }

    public function destroy($id, $tipe): void
    {
        $this->metodeId = $id;
        $this->deleteTipe = $tipe;

        $this->confirm('Anda yakin ingin menghapus ??', [
            'onConfirmed' => 'confirmedDelete',
        ]);
    }

    public function delete($id, $tipe): void
    {
        if ('bulk' === $tipe) {
            $delete = $this->metodeBayar->query()->whereKey($this->checked)->delete();
            $this->checked = [];
        } else {
            $delete = $this->metodeBayar->findOrFail($id)->delete();
        }
        $this->sendNotifikasi($delete);
    }

    private function sendNotifikasi($model): void
    {
        if ($model) {
            $this->alert('success', 'Metode Bayar berhasil disimpan atau diperbarui');
        } else {
            $this->alert('danger', 'Metode Bayar gagal disimpan atau diperbarui');
        }
    }

    public function render(): Factory|View|Application
    {
        $listMetode = $this->metodeBayar
//            ->search($this->search)
            ->orderBy($this->orderBy, $this->direction)
            ->paginate($this->perPage)
        ;

        $this->pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listMetode->total(),
        ];

        return view('livewire.master.metode-bayar.list-metode-bayar', compact('listMetode'));
    }
}
