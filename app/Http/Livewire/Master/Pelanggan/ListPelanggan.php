<?php

namespace App\Http\Livewire\Master\Pelanggan;

use App\Concerns\HasBayarTagihan;
use App\Concerns\HasBulkAction;
use App\Concerns\HasStat;
use App\Concerns\WithModal;
use App\Concerns\WithTitle;
use App\Events\PaymentCreated;
use App\Models\Customers;
use App\Models\GolonganTarif;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\Zone;
use App\Utilities\Helpers;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Validator;

class ListPelanggan extends Component
{
    use WithPagination, HasStat, LivewireAlert, WithTitle, WithModal, HasBulkAction, AuthorizesRequests, HasBayarTagihan;

    protected string $paginationTheme = 'bootstrap';

    public Customers $customers;

    public Payment $payments;

    public int $perPage = 15;

    public string $search = '';

    public string $status = '';

    public string $zona = '';

    public string $golongan = '';

    public string $valid = '';

    public int $statusPelanggan = 1;

    protected $queryString = [
        'search' => ['except' => '', 'alias' => 'q'],
        'status' => ['except' => '', 'alias' => 's'],
        'zona' => ['except' => '', 'alias' => 'z'],
        'golongan' => ['except' => '', 'alias' => 'g'],
        'valid' => ['except' => '', 'alias' => 'v'],
    ];

    public bool $updateMode = false;

    public array $pelanggan = [];

    public int $golonganId = 0;

    public string $deleteTipe = 'single';

    protected $listeners = [
        'delete',
        'updatePelanggan' => 'render',
        'pelangganCount',
        'updateValid' => 'updateStatusValid',
        'updateStatusConfirmed',
        'confirmed',
        'cancelled',
        'denied',
        'confirmedDeleteAll',
        'dismissedDeleteAll',
    ];

//    public int $pembayaranId;

    public bool $validPelanggan;

    /**
     * @throws AuthorizationException
     */
    public function mount(Customers $customers): void
    {
        if (!$this->authorize('show pelanggan', $customers)) {
            abort(403);
        }

        $this->setTitle('Pelanggan');
        $this->breadcrumbs = [['link' => 'home', 'name' => 'Dashboard'], ['name' => $this->getTitle()]];
        $this->setModalId('modal-pelanggan');
        $this->customers = $customers;
        $this->model = $customers;
    }

    public function updateStatus($id): void
    {
        $this->pelangganId = $id;

        $this->confirm('Anda yakin pelanggan ini valid ??', [
            'onConfirmed' => 'updateStatusConfirmed',
            'confirmButtonText' => 'Ya, Ubah',
        ]);
    }

    public function deleteAllPelanggan(): void
    {
        $this->confirm('Anda yakin ingin menghapus semua pelanggan ?', [
            'onConfirmed' => 'confirmedDeleteAll',
            'onDismissed' => 'dismissedDeleteAll',
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function confirmedDeleteAll(): void
    {
        $this->authorize('delete_customer', $this->customers);
        if ($this->customers->delete()) {
            $this->alert('success', 'Semua pelanggan berhasil dihapus');
        } else {
            $this->alert('error', 'Semua Pelanggan gagal dihapus');
        }
    }

    public function dismissedDeleteAll(): void
    {
        $this->resetSelectedRows();
    }

    public function resetForms(): void
    {
        $this->reset('search', 'status', 'selectedRows', 'pembayaran');
    }

    /**
     * @throws AuthorizationException
     */
    public function confirmed(): void
    {
        $this->delete($this->pelangganId, $this->deleteTipe);
    }

    public function updateStatusConfirmed(): void
    {
        $this->updateStatusValid($this->pelangganId);
    }


    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function renderPelangganCount(): void
    {
        $this->customers->getCountValidPelanggan();
        $this->customers->getCountValidPelanggan(false);
    }

    public function updating(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage($value): void
    {
        $this->perPage = $value;
    }

    public function destroy($id, $tipe): void
    {
        $this->pelangganId = $id;
        $this->deleteTipe = $tipe;

        $this->confirm('Anda yakin ingin menghapus ??', [
            'onConfirmed' => 'confirmed',
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function delete($id, $tipe): void
    {
        $this->authorize('delete pelanggan', $this->customers);
        if ('bulk' === $tipe) {
            $delete = $this->customers->whereKey($this->selectedRows)->delete();
            $this->selectedRows = [];
        } else {
            $delete = $this->customers->findOrFail($id)->delete();
        }

        if ($delete) {
            $this->alert('success', 'Pelanggan berhasil dihapus');
        } else {
            $this->alert('danger', 'Pelanggan gagal dihapus');
        }
    }

    public function updateStatusValid($id): void
    {
        $customer = $this->customers->find($id);

        if (!is_null($customer)) {
            $isValid = $customer->is_valid === 1 ? 1 : 0;
            if ($customer->update(['is_valid' => $isValid])) {
                $this->alert('success', 'Status pelanggan berhasil diubah');
            } else {
                $this->alert('danger', 'Status pelanggan gagal diubah');
            }
        } else {
            $this->alert('info', 'Pelanggan tidak ditemukan');
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function bayarTagihan($id): void
    {
        $this->authorize('create pembayaran', $this->customers);
        $this->pelangganId = $id;
        $customer = $this->customers->with(['golonganTarif', 'zona', 'payment', 'catatmeter'])->find($this->pelangganId);
        $jumlahPemakaianAir = (int) $customer->catatmeter?->angka_meter_baru - (int) $customer->catatmeter?->angka_meter_lama;
        $this->golonganId = $customer->golongan_id;
        $this->pembayaran['no_transaksi'] = Helpers::generateNoTransaksi();
        $this->pembayaran['customer_id'] = $this->pelangganId;
        $this->pembayaran['bulan_berjalan'] = setting('bulan', now()->month);
        $this->pembayaran['tahun_berjalan'] = setting('tahun_periode', now()->year);
        $this->pembayaran['periode'] = now()->format('Y-m-d');
        $this->pembayaran['stand_awal'] = $customer->catatmeter?->angka_meter_lama;
        $this->pembayaran['stand_akhir'] = $customer->catatmeter?->angka_meter_baru;
        $this->pembayaran['pemakaian_air_saat_ini'] = $jumlahPemakaianAir;
        $hargaAir = $this->hitungHargaAir($this->pembayaran['pemakaian_air_saat_ini'], $customer->golonganTarif);
        $totalTagihan = ($hargaAir['hargaAir'] * $this->pembayaran['pemakaian_air_saat_ini']) + $hargaAir['danaMeter'] + $hargaAir['biayaLayanan'];
        $this->pembayaran['harga_air'] = $hargaAir['hargaAir'];
        $this->pembayaran['dana_meter'] = $hargaAir['danaMeter'];
        $this->pembayaran['biaya_layanan'] = $hargaAir['biayaLayanan'];
        $this->pembayaran['total_tagihan'] = $totalTagihan;

        if ($customer->status_pelanggan !== 1) {
            $this->statusPelanggan = $customer->status_pelanggan;
            $this->alert('error', 'Status Pelanggan tidak aktif. Harap lunasi pembayaran tertunggak dan aktifkan status pelanggan');
            if (!$customer->is_valid) {
                $this->alert('error', 'Pelanggan tidak valid. Harap validasi pelanggan terlebih dahulu');
            }
            return;
        }

        $this->openModal();
        $this->dispatchBrowserEvent('loading', ['show' => true]);
    }

    /**
     * @throws AuthorizationException
     */
    public function prosesPembayaran(): void
    {
        $this->authorize('create pembayaran', auth()->user());
        $validated = Validator::make($this->pembayaran, [
            'bulan_berjalan' => 'required',
            'tahun_berjalan' => 'required',
            'stand_awal' => 'required',
            'stand_akhir' => 'required',
            'total_bayar' => 'required',
            'total_tagihan' => 'required',
            'biaya_layanan' => 'required',
            'dana_meter' => 'required',
            'harga_air' => 'required',
            'pemakaian_air_saat_ini' => 'required',
            'status_pembayaran' => 'required',
            'keterangan' => 'nullable|max:255',
        ])->validate();

        $customer = $this->customers->find($this->pelangganId);

        if (! is_null($customer)) {
            $golonganTarif = $customer->golonganTarif->first();
            $tglPembayaran = setting('tgl_pembayaran', $golonganTarif->tgl_bayar_akhir);
            $validated['customer_id'] = $customer->id ?? $this->pelangganId;
            $validated['no_transaksi'] = $this->pembayaran['no_transaksi'];
            $validated['user_id'] = auth()->user()->id;
            $validated['pemakaian_air_sebelumnya'] = $customer->pemakaian_air_saat_ini;
            $validated['sisa'] = $this->hitungSisa($validated['total_bayar'], $validated['total_tagihan']);
            $validated['tgl_bayar'] = now();
            $validated['periode'] = Carbon::createFromDate($validated['tahun_berjalan'], $validated['bulan_berjalan'], $tglPembayaran);
            $validated['tgl_jatuh_tempo'] = Carbon::createFromDate($validated['tahun_berjalan'], $validated['bulan_berjalan'], $tglPembayaran)->addMonths(1);

            if (Payment::checkPembayaran($customer->id, $validated['bulan_berjalan'], $validated['tahun_berjalan'])) {
                $this->alert('info', 'Pelanggan sudah membayar untuk bulan ini');

                return;
            }

            $createPembayaran = Payment::updateOrCreate([
                'customer_id' => $customer->id,
                'bulan_berjalan' => $validated['bulan_berjalan'],
                'tahun_berjalan' => $validated['tahun_berjalan'],
            ], $validated);

            if ($createPembayaran) {
                PaymentCreated::dispatch($createPembayaran);
                $this->pembayaranId = $createPembayaran->id;
                $this->reset('pembayaran');
                $this->closeModal();
                $this->alert('success', 'Pembayaran berhasil ditambahkan');
            } else {
                $this->resetForms();
                $this->resetValidation();
                $this->alert('danger', 'Pembayaran gagal ditambahkan');
            }
        } else {
            $this->alert('info', 'Pelanggan tidak ditemukan');
        }
    }

    private function checkPelanggan(): void
    {
        if (! $this->validPelanggan) {
            $this->alert('error', 'Pelanggan tidak valid. Harap validasi pelanggan terlebih dahulu');
        }

        if ($this->statusPelanggan === 2) {
            $this->alert('error', 'Status Pelanggan Ditangguhkan. Tidak dapat melakukan pembayaran');
        }

        if ($this->statusPelanggan === 3) {
            $this->alert('error', 'Status Pelanggan Didop. Harap hubungi admin untuk mengaktifkan pelanggan');
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function cetakBukti(): void
    {
        $this->checkPelanggan();
        $this->prosesPembayaran();

        if (! is_null($this->pembayaranId)) {
            $this->redirectRoute('cetak.bukti-pembayaran', [
                'page' => 'rekening-air',
                'pelangganId' => $this->pelangganId,
                'pembayaranId' => $this->pembayaranId,
            ]);
        } else {
            $this->alert('error', 'Pembayaran gagal ditambahkan');
        }
    }

    private function hitungSisa(float $bayar, float $tagihan): float|int|string
    {
        if ($bayar > $tagihan) {
            $sisa = $bayar - $tagihan;
        } elseif ($bayar < $tagihan) {
            $sisa = '-'.$tagihan - $bayar;
        } else {
            $sisa = 0;
        }

        return $sisa;
    }

    private function renderCustomers()
    {
        return $this->customers
            ->when($this->search, function ($query) {
                return $query->search($this->search);
            })
            ->select('id', 'no_sambungan', 'alamat_pelanggan', 'nama_pelanggan', 'is_valid', 'golongan_id', 'zona_id', 'status_pelanggan')
            ->with(['statusPelanggan', 'golonganTarif', 'zona'])
            ->when($this->zona, function ($q) {
                $q->select('id')->whereHas('zona', function ($q) {
                    return $q->where('id', $this->zona);
                });
            })
            ->when($this->status, function ($q) {
                $q->whereHas('statusPelanggan', function ($q) {
                    return $q->select('id')->where('id', $this->status);
                });
            })
            ->when($this->golongan, function ($q) {
                $q->whereHas('golonganTarif', function ($q) {
                    return $q->select('id')->where('id', $this->golongan);
                });
            })
            ->when($this->valid, function ($q) {
                return $q->where('is_valid', $this->valid);
            })
            ->orderBy('no_sambungan')
            ->fastPaginate($this->perPage);
    }

    public function render(): Factory|View|Application
    {
        $listCustomers = $this->renderCustomers();
        
        $this->renderPelangganCount();

        $listZona = Zone::pluck('wilayah', 'id');
        $listGolongan = GolonganTarif::pluck('nama_golongan', 'id');
        $listStatus = PaymentStatus::pluck('name', 'id');

        $listBulan = config('custom.list_bulan');
        $listTahun = config('custom.list_tahun');

        $pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listCustomers->total(),
            'breadcrumbs' => $this->breadcrumbs,
            'listZona' => $listZona,
            'listGolongan' => $listGolongan,
            'listStatus' => $listStatus,
            'listBulan' => $listBulan,
            'listTahun' => $listTahun,
        ];

        return view('livewire.master.pelanggan.list-pelanggan', compact('pageData', 'listCustomers'));
    }
}
