<?php

namespace App\Http\Livewire\Master\Pelanggan;

use App\Concerns\HasStat;
use App\Events\PaymentCreated;
use App\Models\Customers;
use App\Models\GolonganTarif;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\Zone;
use App\Utilities\Helpers;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Validator;

class ListPelanggan extends Component
{
    use WithPagination, HasStat, LivewireAlert, AuthorizesRequests;

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

    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $updateMode = false;
    public bool $selectAllPelanggan = false;

    public array $pelanggan = [];
    public array $pembayaran = [];
    public int $pelangganId = 0;
    public int $golonganId = 0;
    public string $deleteTipe = 'single';

    public string $title = 'Pelanggan';
    public string $modalId = 'modal-pelanggan';
    public $breadcrumb = [
        ['link' => 'home', 'name' => 'Dashboard'], ['name' => 'Pelanggan']
    ];
    public array $breadcrumbs = [
        ['link' => 'home', 'name' => 'Dashboard'], ['name' => 'Pelanggan']
    ];

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
        'dismissedDeleteAll'
    ];

    public int $pembayaranId;

    public function isChecked($id): bool
    {
        return in_array($id, $this->checked, true);
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
        $deleteAll = $this->customers->delete();
        if ($deleteAll) {
            $this->alert('success', 'Semua pelanggan berhasil dihapus');
        } else {
            $this->alert('error', 'Semua Pelanggan gagal dihapus');
        }
    }

    public function dismissedDeleteAll(): void
    {
        $this->resetCheckbox();
    }

    public function selectAllData(): void
    {
        $this->selectAllPelanggan = true;
        $this->checked = $this->customers->pluck('id')->toArray();
    }

    public function updatedSelectAll($value): void
    {
        if ($value) {
            $this->checked = $this->customers->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
            $this->selectAllPelanggan = false;
        }
    }

    public function resetCheckbox(): void
    {
        $this->checked = [];
        $this->selectAllPelanggan = false;
        $this->selectAll = false;
    }

    public function resetForms(): void
    {
        $this->reset('search', 'status', 'checked', 'pembayaran');
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

    public function denied(): void
    {
    }

    public function cancelled(): void
    {
        // Do something when cancel button is clicked
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function mount(Customers $customers): void
    {
        $this->customers = $customers;
    }

    public function renderPelangganCount(): void
    {
//        $customers = $this->customers->query();

        $this->totalPelangganValid = $this->customers->query()
            ->search($this->search)
            ->when($this->zona, function ($q) {
                $q->whereHas('zona', function ($q) {
                    return $q->where('id', $this->zona);
                });
            })
            ->when($this->status, function ($q) {
                $q->whereHas('statusPelanggan', function ($q) {
                    return $q->where('id', $this->status);
                });
            })
            ->when($this->golongan, function ($q) {
                $q->whereHas('golonganTarif', function ($q) {
                    return $q->where('id', $this->golongan);
                });
            })
            ->when($this->valid, function ($q) {
                return $q->where('is_valid', (int) $this->valid);
            })
            ->where('is_valid', true)->get()->count();

        $this->totalPelangganTidakValid = $this->customers->query()
            ->when($this->zona, function ($q) {
                $q->whereHas('zona', function ($q) {
                    return $q->where('id', $this->zona);
                });
            })
            ->when($this->status, function ($q) {
                $q->whereHas('statusPelanggan', function ($q) {
                    return $q->where('id', $this->status);
                });
            })
            ->when($this->golongan, function ($q) {
                $q->whereHas('golonganTarif', function ($q) {
                    return $q->where('id', $this->golongan);
                });
            })
            ->when($this->valid, function ($q) {
                return $q->where('is_valid', $this->valid);
            })
            ->where('is_valid', false)->get()->count();
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
            //            'onDismissed' => 'cancelled',
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function delete($id, $tipe): void
    {
        $this->authorize('delete_customer', $this->customers);
        if ('bulk' === $tipe) {
            $delete = $this->customers->whereKey($this->checked)->delete();
            $this->checked = [];
        } else {
            $delete = $this->customers->findOrFail($id)->delete();
        }

        if ($delete) {
            $this->alert('success', 'Pelanggan berhasil dihapus');
        } else {
            $this->alert('danger', 'Pelanggan gagal dihapus');
        }
    }

    public function updateStatus($id): void
    {
        $this->pelangganId = $id;

        $this->confirm('Anda yakin pelanggan ini valid ??', [
            'onConfirmed' => 'updateStatusConfirmed',
            'confirmButtonText' => 'Ya, Ubah',
        ]);
    }

    public function updateStatusValid($id): void
    {
        $customer = $this->customers->find($id);

        if (!is_null($customer)) {
            $valid = !$customer->is_valid ? 1 : 0;
            if ($customer->update(['is_valid' => $valid])) {
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
        $this->authorize('create_pembayaran', $this->customers);
        $this->pelangganId = $id;
        $customer = $this->customers->with(['golonganTarif', 'zona', 'payment','catatmeter'])->find($this->pelangganId);
        $this->golonganId = $customer->golongan_id;
        $this->pembayaran['no_transaksi'] = Helpers::generateNoTransaksi();
        $this->pembayaran['customer_id'] = $this->pelangganId;
        $this->pembayaran['bulan_berjalan'] = setting('bulan', now()->month);
        $this->pembayaran['tahun_berjalan'] = setting('tahun_periode', now()->year);
        $this->pembayaran['periode'] = now()->format('Y-m-d');
        $this->pembayaran['stand_awal'] = $customer->catatmeter?->angka_meter_lama;
        $this->pembayaran['stand_akhir'] = $customer->catatmeter?->angka_meter_baru;
        $this->pembayaran['pemakaian_air_saat_ini'] = (int) $customer->catatmeter?->angka_meter_lama - (int) $customer->catatmeter?->angka_meter_baru;
//        $this->validPelanggan = $customer->is_valid;

        if (!$customer->is_valid) {
            $this->alert('error', 'Pelanggan tidak valid. Harap validasi pelanggan terlebih dahulu');
            return;
        }

        if ($customer->status_pelanggan !== 1) {
            $this->statusPelanggan = $customer->status_pelanggan;
            $this->alert('error', 'Status Pelanggan tidak aktif. Harap lunasi pembayaran tertunggak dan aktifkan status pelanggan');
            return;
        }

//        if($customer->status_pelanggan === 3){
//            $this->statusPelanggan = 3;
//            $this->alert('error', 'Status Pelanggan Didop. Harap hubungi admin untuk mengaktifkan pelanggan');
//            return;
//        }

        $this->openModal(['pembayaran' => $this->pembayaran]);
    }

    public function updatedPembayaranStandAkhir($value): void
    {
        $pemakaianAir = (int)$this->pembayaran['stand_awal'] - (int)$value;
        $this->pembayaran['pemakaian_air_saat_ini'] = $pemakaianAir;

        $hitung = $this->hitungHargaAir($pemakaianAir, Helpers::getModelInstance('GolonganTarif'));
        $this->pembayaran['harga_air'] = $hitung['hargaAir'];
        $this->pembayaran['dana_meter'] = $hitung['danaMeter'];
        $this->pembayaran['biaya_layanan'] = $hitung['biayaLayanan'];
        $this->pembayaran['total_tagihan'] = ($hitung['hargaAir'] * $pemakaianAir) + $hitung['biayaLayanan'];
    }

    private function hitungHargaAir($value, $model)
    {
        $golongan = $model::find($this->golonganId);

        if ($value >= 0 && $value <= 10) {
            $hargaAir = $golongan->tarif_blok_1;
        } elseif ($value >= 11 && $value <= 20) {
            $hargaAir = $golongan->tarif_blok_2;
        } elseif ($value >= 21 && $value <= 30) {
            $hargaAir = $golongan->tarif_blok_3;
        } elseif ($value >= 31) {
            $hargaAir = $golongan->tarif_blok_4;
        } else {
            $hargaAir = $golongan->tarif_blok_1;
        }

        $danaMeter = $golongan->dana_meter;
        $biayaLayanan = $golongan->biaya_administrasi;
        $this->pembayaran['dana_meter'] = $golongan->dana_meter;
        $this->pembayaran['biaya_layanan'] = $golongan->biaya_administrasi;

        return [
            'hargaAir' => $hargaAir,
            'danaMeter' => $danaMeter,
            'biayaLayanan' => $biayaLayanan,
        ];
    }

    public function updatedPembayaranPemakaianAirSaatIni($value): void
    {
        $hitung = $this->hitungHargaAir($value, Helpers::getModelInstance('GolonganTarif'));
        $this->pembayaran['harga_air'] = $hitung['hargaAir'];
        $this->pembayaran['dana_meter'] = $hitung['danaMeter'];
        $this->pembayaran['total_tagihan'] = ($hitung['hargaAir'] * $value) + $hitung['biayaLayanan'];
    }

    /**
     * @throws AuthorizationException
     */
    public function prosesPembayaran(): void
    {
        $this->authorize('create_pembayaran', auth()->user());
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

        if (!is_null($customer)) {
            $golongan = $customer->golonganTarif->first();
            $tglPembayaran = setting('tgl_pembayaran', $golongan->tgl_bayar_akhir);
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

            $pembayaran = Payment::updateOrCreate([
                'customer_id' => $customer->id,
                'bulan_berjalan' => $validated['bulan_berjalan'],
                'tahun_berjalan' => $validated['tahun_berjalan'],
            ], $validated);

            if ($pembayaran) {
                PaymentCreated::dispatch($pembayaran);
                $this->pembayaranId = $pembayaran->id;
                $this->reset('pembayaran');
                $this->closeModal();
                $this->alert('success', 'PembayaranPajak berhasil ditambahkan');
            } else {
                $this->resetForms();
                $this->resetValidation();
                $this->alert('danger', 'PembayaranPajak gagal ditambahkan');
            }
        } else {
            $this->alert('info', 'Pelanggan tidak ditemukan');
        }
    }

    private function checkPelanggan(): void
    {
        if (!$this->validPelanggan) {
            $this->alert('error', 'Pelanggan tidak valid. Harap validasi pelanggan terlebih dahulu');
            return;
        }

        if ($this->statusPelanggan === 2) {
            $this->alert('error', 'Status Pelanggan Ditangguhkan. Tidak dapat melakukan pembayaran');
            return;
        }

        if ($this->statusPelanggan === 3) {
            $this->alert('error', 'Status Pelanggan Didop. Harap hubungi admin untuk mengaktifkan pelanggan');
            return;
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function cetakBukti(): void
    {
        $this->checkPelanggan();
        $this->prosesPembayaran();

        if (!is_null($this->pembayaranId)) {
            $this->redirectRoute('cetak.bukti-pembayaran', [
                'page' => 'rekening-air',
                'pelangganId' => $this->pelangganId,
                'pembayaranId' => $this->pembayaranId,
            ]);
        } else {
            $this->alert('error', 'PembayaranPajak gagal ditambahkan');
        }
    }

    private function closeModal($options = false): void
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('closeModalBayar', $options);
    }

    private function openModal($options = false): void
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('openModalBayar', $options);
    }

    private function hitungSisa(float $bayar, float $tagihan): float|int|string
    {
        if ($bayar > $tagihan) {
            $sisa = $bayar - $tagihan;
        } elseif ($bayar < $tagihan) {
            $sisa = '-' . $tagihan - $bayar;
        } else {
            $sisa = 0;
        }

        return $sisa;
    }

    public function renderCustomers()
    {
        return $this->customers->search($this->search)
            ->with(['statusPelanggan', 'golonganTarif', 'zona'])
            ->when($this->zona, function ($q) {
                $q->whereHas('zona', function ($q) {
                    return $q->where('id', $this->zona);
                });
            })
            ->when($this->status, function ($q) {
                $q->whereHas('statusPelanggan', function ($q) {
                    return $q->where('id', $this->status);
                });
            })
            ->when($this->golongan, function ($q) {
                $q->whereHas('golonganTarif', function ($q) {
                    return $q->where('id', $this->golongan);
                });
            })
            ->when($this->valid, function ($q) {
                return $q->where('is_valid', $this->valid);
            })
            ->orderBy('no_sambungan')
            ->fastPaginate($this->perPage);
//            ->paginate($this->perPage);
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
            'breadcrumbs' => $this->breadcrumb,
            'listZona' => $listZona,
            'listGolongan' => $listGolongan,
            'listStatus' => $listStatus,
            'listBulan' => $listBulan,
            'listTahun' => $listTahun,
        ];

        return view('livewire.master.pelanggan.list-pelanggan', compact('pageData', 'listCustomers'));
    }
}
