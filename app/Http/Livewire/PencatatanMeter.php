<?php

namespace App\Http\Livewire;

use App\Events\CatatMeterCreated;
use App\Models\CatatMeter;
use App\Models\Customers;
use App\Models\GolonganTarif;
use App\Utilities\Helpers;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class PencatatanMeter extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected string $paginationTheme = 'bootstrap';

    public CatatMeter $catatMeter;

    public int $perPage = 15;
    public string $orderBy = 'id';
    public string $search = '';
    public string $golongan = '';
    public string $bulan = '';
    public string $direction = 'asc';
    public string $defaultSortBy = 'id';

    protected $queryString = [
        'search' => ['except' => '', 'as' => 'q'],
        'bulan' => ['except' => '', 'as' => 'b'],
        'golongan' => ['except' => '', 'as' => 'g'],
    ];

    public array $pageData = [];
    public array $checked = [];
    public array $state = [];
    public array $selectedItems = [];
    public $selectedItem;
    public bool $isChecked = false;
    public bool $selectAllCatatMeter = false;
    public bool $updateMode = false;
    public bool $selectAllMeter = false;
    public string $deleteTipe = 'single';

    public $catatMeterId;

    public string $title = 'List Pencatatan Meter';
    public bool $show = true;
    public string $modalId = 'modal-catatmeter';

    protected $listeners = [
        'delete',
        'updatePencatatanMeter' => 'render',
        'confirmed',
        'cancelled',
        'denied',
    ];

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function confirmed(): void
    {
        $this->delete($this->catatMeterId, $this->deleteTipe);
    }

    public function mount(CatatMeter $catatMeter): void
    {
        $this->catatMeter = $catatMeter;
    }

    public function updatedStateCustomerId($value): void
    {
        $this->state['customer_id'] = $value;
        $this->selectedItem = (int) $value;
    }

    public function isChecked($id): bool
    {
        $this->catatMeterId = $id;
        return in_array($id, $this->checked, true);
    }

    public function selectAllData(): void
    {
        $this->selectAllMeter = true;
        $this->checked = $this->catatMeter->pluck('id')->toArray();
    }

    public function updatedSelectAllCatatMeter($value): void
    {
        $this->checked = [];
        $this->isChecked = false;
        $this->selectAllMeter = false;

        if ($value) {
            $this->checked = $this->catatMeter->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        }
    }

    public function resetCheckbox(): void
    {
        $this->checked = [];
        $this->selectAllMeter = false;
        $this->selectAllCatatMeter = false;
    }

    public function resetField(): void
    {
        $this->reset('state', 'checked');
        $this->resetErrorBag();
        $this->updateMode = false;
        $this->dispatchBrowserEvent('customerId');
    }

    public function updating(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage($value): void
    {
        $this->perPage = $value;
    }

    public function editCatatMeter($id): void
    {
        $this->updateMode = true;
        $catatMeter = $this->catatMeter->find($id);
        $this->catatMeterId = $catatMeter->id ?? $id;
        $this->state['customer_id'] = [$catatMeter->customer_id];
        $this->selectedItems = [(int) $catatMeter->customer_id];
        $this->selectedItem = (int) $catatMeter->customer_id;
        $this->state['user_id'] = $catatMeter->user_id;
        $this->state['angka_meter_lama'] = $catatMeter->angka_meter_lama;
        $this->state['angka_meter_baru'] = $catatMeter->angka_meter_baru;
        $this->state['status_meter'] = $catatMeter->status_meter;
        $this->state['bulan'] = $catatMeter->bulan;
        $this->state['keterangan'] = $catatMeter->keterangan;
        $this->openModal(['state' => $this->state, 'selectedItem' => $this->selectedItem]);
    }

    public function addCatatMeter(): void
    {
        $this->updateMode = false;
        $this->resetField();
        $this->openModal();
        $this->emit('clearPelanggan');
    }

    public function storeCatatMeter(): void
    {
        $validated = Validator::make($this->state, [
            'customer_id' => 'required|integer|unique:catat_meter,customer_id',
//            'angka_meter_lama' => 'integer',
            'angka_meter_baru' => 'required|integer',
            'bulan' => 'required|integer',
            'keterangan' => 'nullable|max:255',
        ])->validate();

        $validated['user_id'] = auth()->user()->id;
        $validated['status_meter'] = 1;
        $validated['angka_meter_lama'] = $validated['angka_meter_baru'];

        $create = $this->catatMeter->create($validated);
        $create->customer()->associate([
            'angka_meter_lama' => $create->angka_meter_lama,
            'angka_meter_baru' => $create->angka_meter_baru,
        ]);
//        CatatMeterCreated::dispatch($create);
        $this->sendNotifikasi($create);
        $this->resetField();
        $this->closeModal();
        $this->dispatchBrowserEvent('clearPelanggan');
    }

    public function sendNotifikasi($model): void
    {
        if ($model) {
            $this->alert('success', 'Catat Meter Berhasil Disimpan');
        } else {
            $this->alert('danger', 'Catat Meter Gagal Disimpan');
        }
    }

    public function updateCatatMeter(): void
    {
        $validated = Validator::make($this->state, [
            'customer_id' => 'required|integer',
//            'user_id' => 'required|integer',
//            'angka_meter_lama' => 'nullable|integer',
            'angka_meter_baru' => 'require|integer',
            'keterangan' => 'nullable|max:255',
        ])->validate();

        $validated['user_id'] = auth()->user()->id;
        $validated['status_meter'] = 1;

        $update = $this->catatMeter->find($this->catatMeterId);
        $validated['angka_meter_lama'] = $update->angka_meter_lama;
        $update->update($validated);
        $update->customer()->associate([
            'angka_meter_lama' => $update->angka_meter_lama,
            'angka_meter_baru' => $update->angka_meter_baru,
        ]);
        $this->sendNotifikasi($update);
        $this->resetField();
        $this->closeModal();
        $this->dispatchBrowserEvent('clearPelanggan');
    }

    public function destroy($id, $tipe): void
    {
        $this->catatMeterId = $id;
        $this->deleteTipe = $tipe;

        $this->confirm('Anda yakin ingin menghapus ??', [
            'onConfirmed' => 'confirmed'
        ]);
    }

    public function delete($id, $tipe): void
    {
        if ($tipe === 'bulk') {
            $delete = $this->catatMeter->whereKey($this->checked)->delete();
            $this->checked = [];
        } else {
            $delete = $this->catatMeter->findOrFail($id)->delete();
        }

        if ($delete) {
            $this->alert('success', 'Catatan Meter berhasil dihapus');
        } else {
            $this->alert('danger', 'Catatan Meter gagal dihapus');
        }
    }

//    public function delete($id, $tipe)
//    {
//        if ('bulk' === $tipe) {
//            $delete = $this->catatMeter->query()->whereKey($this->checked)->delete();
//            $this->checked = [];
//        } else {
//            $delete = $this->catatMeter->findOrFail($id)->delete();
//        }
//        $this->sendNotifikasi($delete, 'sendNotif');
//    }

//    private function alert($options = false, $event = 'notifikasi')
//    {
//        $options = ($options && is_array($options)) ? $options : [];
//        $this->dispatchBrowserEvent($event, $options);
//    }

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

//    private function sendNotifikasi($model, $event = 'notifikasi')
//    {
//        if ($model) {
//            $this->alert([
//                'type' => 'success',
//                'title' => 'Berhasil!!',
//                'message' => 'Data berhasil disimpan',
//            ], $event);
//        } else {
//            $this->alert([
//                'type' => 'error',
//                'title' => 'Gagal!!',
//                'message' => 'Data gagal dihapus',
//            ], $event);
//        }
//    }

    public function resetFilter()
    {
        $this->search = '';
//        $this->zona = '';
//        $this->status = '';
        $this->golongan = '';
    }


    public function render(): Factory|View|Application
    {
        $listCatatMeter = $this->catatMeter->query()
            ->with(['customer', 'customer.golonganTarif', 'petugas'])
            ->search($this->search)
            ->when($this->bulan, function ($query) {
                return $query->where('bulan', $this->bulan);
            })
            ->when($this->golongan, function ($query) {
                $query->whereHas('customer.golonganTarif', function ($query){
                    return $query->where('id' ,$this->golongan);
                });
            })
            ->orderBy($this->orderBy, $this->direction)
            ->paginate($this->perPage);

        $listGolongan = GolonganTarif::pluck('nama_golongan', 'id');

        $listBulan = Helpers::list_bulan();

        $listPelanggan = Customers::select('id', 'nama_pelanggan', 'no_sambungan')
            ->get()
            ->transform(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_pelanggan' => $item->nama_pelanggan,
                    'no_sambungan' => $item->no_sambungan,
                ];
            });

        $this->pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listCatatMeter->total(),
            'listGolongan' => $listGolongan,
            'listBulan' => $listBulan,
        ];

        return view('livewire.pencatatan-meter', compact('listCatatMeter', 'listPelanggan'));
    }
}
