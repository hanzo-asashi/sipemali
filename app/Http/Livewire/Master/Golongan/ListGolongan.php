<?php

namespace App\Http\Livewire\Master\Golongan;

use App\Models\GolonganTarif;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ListGolongan extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';

    public int $perPage;

    public string $orderBy = 'kode_golongan';

    public string $direction = 'desc';

    protected $queryString = [
        'search' => ['except' => '', 'as' => 'q'],
    ];

    public array $pageData = [];

    public array $checked = [];

    public array $golongan = [];

    public bool $show = true;

    public bool $isChecked = false;

    public bool $selectAll = false;

    public bool $updateMode = false;

    public bool $selectAllGolongan = false;

    public string $title = 'List Golongan Tarif';

    public string $modalId = 'modal-golongan';

    public string $deleteTipe = 'single';

    public int $golonganId = 1;

    public GolonganTarif $golonganTarif;

    protected $listeners = [
        'delete',
        'resetField' => 'resetField',
        'confirmedDelete',
        'cancelDelete',
        'denied',
        'delete',
        'updateGolongan' => 'render',
    ];

    public function confirmedDelete(): void
    {
        $this->delete($this->golonganId, $this->deleteTipe);
    }

    public function denied(): void
    {
    }

    public function cancelDelete(): void
    {
        // Do something when cancel button is clicked
    }

    public function destroy($id, $tipe): void
    {
        $this->golonganId = $id;
        $this->deleteTipe = $tipe;

        $this->confirm('Anda yakin ingin menghapus ??', [
            'onConfirmed' => 'confirmedDelete',
            //            'onDismissed' => 'cancelled',
        ]);
    }

    public function mount(GolonganTarif $golonganTarif): void
    {
        $this->perPage = config('custom.page_count', 15);
        $this->golonganTarif = $golonganTarif;
    }

    public function isChecked($id): bool
    {
        return in_array($id, $this->checked, true);
    }

    private function closeModal($options = false): void
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('closeModal', $options);
    }

    private function openModal($options = false): void
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('openModal', $options);
    }

    public function addGolongan(): void
    {
        $this->updateMode = false;
        $this->resetField();
        $this->golongan['kode_golongan'] = '';
        $this->golongan['blok_1'] = 10;
        $this->golongan['blok_2'] = 20;
        $this->golongan['blok_3'] = 30;
        $this->golongan['blok_4'] = 40;
        $this->golongan['biaya_administrasi'] = number_format(2000, 0, ',', '.');
        $this->golongan['dana_meter'] = number_format(2500, 0, ',', '.');

        $this->openModal(['golongan' => $this->golongan]);
    }

    public function editGolongan($id): void
    {
        $this->updateMode = true;
        $this->golonganId = $id;
        $golongan = $this->golonganTarif->find($id);
        $this->golongan['kode_golongan'] = $golongan->kode_golongan;
        $this->golongan['nama_golongan'] = $golongan->nama_golongan;
        $this->golongan['deskripsi'] = $golongan->deskripsi;
        $this->golongan['blok_1'] = $golongan->blok_1;
        $this->golongan['blok_2'] = $golongan->blok_2;
        $this->golongan['blok_3'] = $golongan->blok_3;
        $this->golongan['blok_4'] = $golongan->blok_4;
        $this->golongan['tarif_blok_1'] = $golongan->tarif_blok_1;
        $this->golongan['tarif_blok_2'] = $golongan->tarif_blok_2;
        $this->golongan['tarif_blok_3'] = $golongan->tarif_blok_3;
        $this->golongan['tarif_blok_4'] = $golongan->tarif_blok_4;
        $this->golongan['biaya_administrasi'] = number_format(2000, 0, ',', '.');
        $this->golongan['dana_meter'] = number_format(2500, 0, ',', '.');

        $this->openModal(['golongan' => $this->golongan]);
    }

    public function selectAllData(): void
    {
        $this->selectAllGolongan = true;
        $this->checked = $this->golonganTarif->pluck('id')->toArray();
    }

    public function updatedSelectAll($value): void
    {
        if ($value) {
            $this->checked = $this->golonganTarif->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
            $this->selectAllGolongan = false;
        }
    }

    public function resetCheckbox(): void
    {
        $this->checked = [];
        $this->selectAllGolongan = false;
        $this->selectAll = false;
    }

    public function resetField(): void
    {
        $this->reset('search', 'golongan');
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

    public function storeGolongan(): void
    {
        $validated = Validator::make($this->golongan, [
            'kode_golongan' => 'required|unique:golongans,kode_golongan',
            'nama_golongan' => 'required|max:100',
            'deskripsi' => 'nullable|max:100',
            'blok_1' => 'required|integer',
            'blok_2' => 'required|integer',
            'blok_3' => 'required|integer',
            'blok_4' => 'required|integer',
            'tarif_blok_1' => 'required|integer',
            'tarif_blok_2' => 'required|integer',
            'tarif_blok_3' => 'required|integer',
            'tarif_blok_4' => 'required|integer',
            'biaya_administrasi' => 'required',
            'dana_meter' => 'required',
        ])->validate();

        $create = $this->golonganTarif->create($validated);
        $this->showNotifikasi($create);
        $this->resetField();
        $this->closeModal();
    }

    public function updateGolongan(): void
    {
        $validated = Validator::make($this->golongan, [
            'kode_golongan' => 'required|exists:golongan_tarif,kode_golongan',
            'nama_golongan' => 'required|max:100',
            'deskripsi' => 'required|max:100',
            'blok_1' => 'required|integer',
            'blok_2' => 'required|integer',
            'blok_3' => 'required|integer',
            'blok_4' => 'required|integer',
            'tarif_blok_1' => 'required|integer',
            'tarif_blok_2' => 'required|integer',
            'tarif_blok_3' => 'required|integer',
            'tarif_blok_4' => 'required|integer',
            'biaya_administrasi' => 'required',
            'dana_meter' => 'required',
        ])->validate();

        $golongan = $this->golonganTarif->find($this->golonganId);
        if ($golongan) {
            $golongan->update($validated);
            $this->showNotifikasi($golongan);
            $this->resetField();
        } else {
            $this->showNotifikasi(false);
        }
        $this->closeModal();
    }

    public function delete($id, $tipe): void
    {
        if ($tipe === 'bulk') {
            $delete = $this->golonganTarif->query()->whereKey($this->checked)->delete();
            $this->checked = [];
        } else {
            $delete = $this->golonganTarif->findOrFail($id)->delete();
        }
        $this->showNotifikasi($delete);
    }

    private function showNotifikasi($model): void
    {
        if ($model) {
            $this->alert('success', 'Berhasil disimpan');
        } else {
            $this->alert('error', 'Gagal disimpan');
        }
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render(): Factory|View|Application
    {
        $listGolongan = $this->golonganTarif->query()
//            ->search($this->search)
            ->orderBy($this->orderBy, $this->direction)
            ->paginate($this->perPage);

        $this->pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listGolongan->total(),
        ];

        return view('livewire.master.golongan.list-golongan', compact('listGolongan'));
    }
}
