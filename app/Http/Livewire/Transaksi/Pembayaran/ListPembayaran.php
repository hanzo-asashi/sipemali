<?php

namespace App\Http\Livewire\Transaksi\Pembayaran;

use App\Models\Customers;
use App\Models\GolonganTarif;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\Status;
use App\Models\Zone;
use App\Concerns\HasPayment;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ListPembayaran extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected string $paginationTheme = 'bootstrap';

    public Payment $payment;
    public $detail;
    public string $search = '';
    public int $perPage = 15;
    public string $status = '';
    public string $zona = '';
    public string $golongan = '';

    public float $totalPembayaran;
    public float $totalPiutang;
    public float $totalTagihan;
    public float $totalSisa;
    public float $totalDenda;
    public float $totalBelumBayar;
    public float $totalPembayaranLunas;
    public int $countPembayaranLunas;
    public float $totalPembayaranBatal;
    public int $countPembayaranBatal;
    public float $totalPembayaranSebagian;
    public int $countPembayaranSebagian;
    public float $totalTagihanLunas;
    public float $totalTagihanBatal;
    public float $totalTagihanSebagian;

    protected $queryString = [
        'search' => ['except' => '','as' => 'q'],
        'status' => ['except' => '', 'as' => 's'],
        'zona' => ['except' => '', 'as' => 'z'],
        'golongan' => ['except' => '', 'as' => 'g'],
    ];

    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $updateMode = false;
    public bool $selectAllPembayaran = false;

    public array $pelanggan = [];
    public array $pembayaran = [];
    public int $pembayaranId = 0;
    public string $deleteTipe = 'single';

    public string $title = 'Pembayaran';
    public string $modalId = 'modal-pembayaran';
    public array $breadcrumb = [['link' => 'home', 'name' => 'Dashboard'], ['name' => 'Pembayaran']];
    public array $breadcrumbs = [['link' => 'home', 'name' => 'Dashboard'], ['name' => 'Pembayaran']];

    protected $listeners = [
        'delete',
        'updatePembayaran' => 'render',
        'pelangganCount',
        'confirmed',
        'cancelled',
        'denied',
    ];

    public function isChecked($id): bool
    {
        return in_array($id, $this->checked, true);
    }


    public function selectAllData(): void
    {
        $this->selectAllPembayaran = true;
        $this->checked = $this->payment->pluck('id')->toArray();
    }

    public function updatedSelectAll($value): void
    {
        if ($value) {
            $this->checked = $this->payment->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
            $this->selectAllPembayaran = false;
        }
    }

    public function resetFilter(): void
    {
        $this->search = '';
        $this->zona = '';
        $this->status = '';
        $this->golongan = '';
    }

    public function resetCheckbox(): void
    {
        $this->checked = [];
        $this->selectAllPembayaran = false;
        $this->selectAll = false;
    }

    public function resetForms(): void
    {
        $this->reset('search', 'status', 'checked');
    }

    public function confirmed(): void
    {
        $this->delete($this->pembayaranId, $this->deleteTipe);
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function mount(Payment $payment): void
    {
        $this->payment = $payment;
    }

    private function sumPembayaran($status, $field)
    {
        $query = $this->payment->query()
            ->filterZona($this->zona)
            ->filterStatus($this->status)
            ->filterGolongan($this->golongan);

        if($status === 0){
            return $query->sum($field);
        }

        return $query->where('status_pembayaran', $status)->sum($field);
    }

    public function pembayaranSum(): void
    {
        $this->totalPembayaran = $this->sumPembayaran(0, 'total_bayar');
        $this->totalTagihan = $this->sumPembayaran(0, 'total_tagihan');
        $this->totalTagihanBatal = $this->sumPembayaran(2, 'total_tagihan');
        $this->totalTagihanSebagian = $this->sumPembayaran(3, 'total_tagihan');
    }

    public function updating(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage($value): void
    {
        $this->perPage = (int) $value;
    }

    public function destroy($id, $tipe): void
    {
        $this->pembayaranId = $id;
        $this->deleteTipe = $tipe;

        $this->confirm('Anda yakin ingin menghapus ??', [
            'onConfirmed' => 'confirmed',
//            'onDismissed' => 'cancelled',
        ]);
    }

    public function delete($id, $tipe): void
    {
        if ($tipe === 'bulk') {
            $delete = $this->payment->whereKey($this->checked)->delete();
            $this->checked = [];
        } else {
            $delete = $this->payment->findOrFail($id)->delete();
        }

        if ($delete) {
            $this->alert('success', 'Pembayaran berhasil dihapus');
        } else {
            $this->alert('danger', 'Pembayaran gagal dihapus');
        }
    }
//
//    private function closeModal($options = false)
//    {
//        $options = ($options && is_array($options)) ? $options : [];
//        $this->dispatchBrowserEvent('closeModal', $options);
//    }
//
//    private function openModal($options = false)
//    {
//        $options = ($options && is_array($options)) ? $options : [];
//        $this->dispatchBrowserEvent('openModal', $options);
//    }

//    public function showDetail($id): void
//    {
//        $this->detail = $this->payment->findOrFail($id);
//        $this->openModal(['detail' => $this->detail]);
//    }

    private function renderPembayaran()
    {
        return $this->payment->query()
            ->with(['customer', 'customer.golonganTarif','customer.zona','statusPembayaran','metodeBayar'])
            ->search($this->search)
            ->filterZona($this->zona)
            ->filterStatus($this->status)
            ->filterGolongan($this->golongan)
            ->orderByDesc('bulan_berjalan')
            ->paginate($this->perPage);
    }


    public function render()
    {
        $listPembayaran = $this->renderPembayaran();
        $listZona = Zone::pluck('wilayah', 'id');
        $listGolongan = GolonganTarif::pluck('nama_golongan', 'id');
        $listStatus = PaymentStatus::pluck('name', 'id');

        $listBulan = config('custom.list_bulan');
        $listTahun = config('custom.list_tahun');

        $this->pembayaranSum();

        $pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listPembayaran->total(),
            'breadcrumbs' => $this->breadcrumb,
            'listZona' => $listZona,
            'listGolongan' => $listGolongan,
            'listStatus' => $listStatus,
            'listBulan' => $listBulan,
            'listTahun' => $listTahun,
        ];

        return view('livewire.transaksi.pembayaran.list-pembayaran', compact('pageData', 'listPembayaran'));
    }
}
