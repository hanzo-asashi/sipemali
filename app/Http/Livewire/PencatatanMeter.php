<?php

namespace App\Http\Livewire;

use App\Concerns\HasBulkAction;
use App\Concerns\WithModal;
use App\Concerns\WithTitle;
use App\Models\CatatMeter;
use App\Models\Customers;
use App\Models\GolonganTarif;
use App\Utilities\Helpers;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class PencatatanMeter extends Component
{
    use WithPagination, LivewireAlert, WithTitle, WithModal, HasBulkAction;

    protected string $paginationTheme = 'bootstrap';

    public CatatMeter $catatMeter;

    public $catatMeterId;

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

    public array $state = [];

    public bool $updateMode = false;

    public string $deleteTipe = 'single';

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
        $this->delete($this->catatMeterId ?: $this->modelId, $this->deleteTipe);
    }

    public function mount(CatatMeter $catatMeter): void
    {
        $this->setTitle('List Pencatatan Meter');
        $this->breadcrumbs = [['link' => 'home', 'name' => 'Dashboard'], ['name' => $this->getTitle()]];
        $this->setModalId('modal-catatmeter');
        $this->catatMeter = $catatMeter;
        $this->model = $catatMeter;
    }

    public function updatedStateCustomerId($value): void
    {
        $this->state['customer_id'] = (int) $value;
    }

    public function resetField(): void
    {
        $this->reset('state', 'selectedRows', 'selectedRow');
        $this->resetErrorBag();
        $this->updateMode = false;
        $this->dispatchBrowserEvent('clearPelanggan');
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
        $this->state['customer_id'] = (int) $catatMeter->customer_id;
        $this->state['user_id'] = $catatMeter->user_id;
        $this->state['angka_meter_lama'] = $catatMeter->angka_meter_lama;
        $this->state['angka_meter_baru'] = $catatMeter->angka_meter_baru;
        $this->state['status_meter'] = $catatMeter->status_meter;
        $this->state['bulan'] = $catatMeter->bulan;
        $this->state['keterangan'] = $catatMeter->keterangan;
        $this->options = ['state' => $this->state];
        $this->openModal();
    }

    public function addCatatMeter(): void
    {
        $this->updateMode = false;
        $this->resetField();
        $this->openModal();
        $this->dispatchBrowserEvent('clearPelanggan');
    }

    public function storeCatatMeter(): void
    {
        $validated = Validator::make($this->state, [
            'customer_id' => 'required|integer',
            'angka_meter_baru' => 'required|integer',
            'bulan' => 'required|integer',
            'keterangan' => 'nullable|max:255',
        ])->validate();

        $validated['user_id'] = auth()->user()->id;
        $validated['status_meter'] = 1;
        $validated['angka_meter_lama'] = 0;
        $validated['periode'] = Carbon::create(now()->year, $validated['bulan'], now()->day)->format('Y-m-d H:i:s');

        $check = $this->catatMeter->query()
            ->where('customer_id', $validated['customer_id'])
            ->where('bulan', $validated['bulan'])
            ->first();

        $angkaMeterLama = 0;

        if (! is_null($check)) {
            $angkaMeterLama = $check->angka_meter_lama;
            if ($angkaMeterLama === 0) {
                $angkaMeterLama = $validated['angka_meter_baru'];
            }
            $angkaMeterLama += $validated['angka_meter_baru'];
        }

        $create = $this->catatMeter->create($validated);

        if ($create) {
            $create->customer()->associate([
                'angka_meter_lama' => $angkaMeterLama,
                'angka_meter_baru' => $create->angka_meter_baru,
            ]);
        }
        $this->sendNotifikasi($create, 'Catat Meter');
        $this->resetField();
        $this->closeModal();
        $this->dispatchBrowserEvent('clearPelanggan');
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
        $validated['angka_meter_lama'] = $update->angka_meter_lama === 0 ? 0 : $update->angka_meter_baru;
        $update->update($validated);
        $update->customer()->associate([
            'angka_meter_lama' => $update->angka_meter_lama,
            'angka_meter_baru' => $update->angka_meter_baru,
        ]);
        $this->sendNotifikasi($update, 'Catatan Meter');
        $this->resetField();
        $this->closeModal();
        $this->dispatchBrowserEvent('clearPelanggan');
    }

    public function destroy($id, $tipe): void
    {
        $this->catatMeterId = $id;
        $this->modelId = $id;
        $this->deleteTipe = $tipe;

        $this->confirm('Anda yakin ingin menghapus ??', [
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function delete($id, $tipe): void
    {
        if ($tipe === 'bulk') {
            $delete = $this->catatMeter->whereKey($this->selectedRows)->delete();
            $this->selectedRows = [];
        } else {
            $delete = $this->catatMeter->findOrFail($id)->delete();
        }

        if ($delete) {
            $this->alert('success', 'Catatan Meter berhasil dihapus');
        } else {
            $this->alert('danger', 'Catatan Meter gagal dihapus');
        }
    }

    public function resetFilter(): void
    {
        $this->search = '';
        $this->bulan = '';
        $this->golongan = '';
    }

    public function render(): Factory|View|Application
    {
        $listCatatMeter = $this->catatMeter->query()
            ->with([
                'customer' => static function ($query) {
                    return $query->select('id', 'no_sambungan', 'nama_pelanggan', 'alamat_pelanggan', 'golongan_id');
                },
                'customer.golonganTarif', 'petugas',
            ])
            ->search($this->search)
            ->when($this->bulan, function ($query) {
                return $query->where('bulan', $this->bulan);
            })
            ->when($this->golongan, function ($query) {
                $query->whereHas('customer.golonganTarif', function ($query) {
                    return $query->where('id', $this->golongan);
                });
            })
            ->orderBy($this->orderBy, $this->direction)
            ->paginate($this->perPage);

        $listGolongan = GolonganTarif::pluck('nama_golongan', 'id');

        $listBulan = Helpers::list_bulan();

//        if (Cache::has('pelanggan_cached')) {
//            $listPelanggan = Cache::get('pelanggan_cached');
//        } else {
//            $listPelanggan = Cache::add('pelanggan_cached', Cache::add('pelanggan_cached', Customers::select('id', 'nama_pelanggan', 'no_sambungan')->get()
//                ->transform(function ($item) {
//                    return [
//                        'id' => $item->id,
//                        'nama_pelanggan' => $item->nama_pelanggan,
//                        'no_sambungan' => $item->no_sambungan,
//                    ];
//                })), now()->addMinutes(60));
//        }

//        if (Cache::has('pelanggan_cached')) {
//            $listPelanggan = Cache::get('pelanggan_cached');
//        } else {
//            $listPelanggan = Cache::add('pelanggan_cached',
//                Cache::add('pelanggan_cached', Customers::pluck('nama_pelanggan', 'id')), now()->addMinutes(60));
//        }

        $listPelanggan = Customers::pluck('nama_pelanggan', 'id');

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
