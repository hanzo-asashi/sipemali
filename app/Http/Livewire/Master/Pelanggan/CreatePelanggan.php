<?php

namespace App\Http\Livewire\Master\Pelanggan;

use App\Models\Customers;
use App\Models\GolonganTarif;
use App\Models\Status;
use App\Models\Zone;
use App\Utilities\Helpers;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreatePelanggan extends Component
{
    use LivewireAlert;
    public string $title = 'Buat Pelanggan';
    public Customers $customers;
    public array $pelanggan = [];
    public array $breadcrumbs = [];

    public function mount(Customers $customers): void
    {
        $this->customers = $customers;
        $this->generateNoSambungan();
        $this->breadcrumbs = [['link' => 'home', 'name' => 'Dashboard'], ['name' => $this->title]];
    }

    private function generateNoSambungan(): void
    {
        $this->pelanggan['no_sambungan'] = Helpers::generateKode(1, 1, '');
        $this->pelanggan['no_pelanggan'] = Helpers::generateKode(1, 1, '', true);
        $this->pelanggan['tahun_langganan'] = 2022;
        $this->pelanggan['bulan_langganan'] = now()->month;
        $this->pelanggan['status_pelanggan'] = 1;
        $this->pelanggan['is_valid'] = true;
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function resetForms(): void
    {
        $this->reset('pelanggan');
        $this->generateNoSambungan();
    }

    public function buatDanKembali(): void
    {
        $this->storePelanggan();
        $this->redirectRoute('master.pelanggan.list');
    }

    public function storePelanggan(): void
    {
        $validated = Validator::make($this->pelanggan, [
//            'no_sambungan' => 'required|max:30|unique:pelanggan,no_sambungan',
//            'no_pelanggan' => 'required|max:15|unique:pelanggan,no_pelanggan',
            'nama_pelanggan' => 'required|max:150',
            'alamat_pelanggan' => 'required|max:255',
            'zona_id' => 'required',
            'golongan_id' => 'required',
            'bulan_langganan' => 'required',
            'tahun_langganan' => 'required',
            'status_pelanggan' => 'required',
            'penagihan_pelanggan' => 'required',
            'is_valid' => 'required|boolean',
            'keterangan' => 'max:255|nullable',
        ], [
            'zona_id' => 'Zona harus diisi',
            'golongan_id' => 'Golongan harus diisi',
            'is_valid' => 'Status Valid harus diisi',
        ])->validate();

        $validated['no_sambungan'] = Helpers::generateKode($validated['golongan_id'], $validated['zona_id'], '');
        $validated['no_pelangggan'] = Helpers::generateKode($validated['golongan_id'], $validated['zona_id'], '', true);

        if ($this->customers->create($validated)) {
            $this->resetForms();
            $this->alert('success', 'Berhasil menambahkan pelanggan baru');
        } else {
            $this->alert('error', 'Gagal menambahkan pelanggan baru');
        }
    }

    public function render(): Factory|View|Application
    {
        $listZona = Zone::pluck('wilayah', 'id');
        $listGolongan = GolonganTarif::pluck('nama_golongan', 'id');
        $listStatus = Status::pluck('nama_status', 'id');

        $listBulan = config('custom.list_bulan');
        $listTahun = config('custom.list_tahun');

        $pageData = [
            'listZona' => $listZona,
            'listGolongan' => $listGolongan,
            'listStatus' => $listStatus,
            'listBulan' => $listBulan,
            'listTahun' => $listTahun,
        ];

        return view('livewire.master.pelanggan.create-pelanggan', compact('pageData'));
    }
}
