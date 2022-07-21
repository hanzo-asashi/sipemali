<?php

namespace App\Http\Livewire\Master\Pelanggan;

use App\Concerns\WithTitle;
use App\Models\Customers;
use App\Models\GolonganTarif;
use App\Models\Status;
use App\Models\Zone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditPelanggan extends Component
{
    use LivewireAlert, WithTitle;

    public Customers $customer;

    public array $pelanggan = [];

    public function mount(string $id): void
    {
        $this->setTitle('Ubah Pelanggan');
        $this->breadcrumbs = [['link' => 'home', 'name' => 'Dashboard'], ['name' => $this->getTitle()]];
        $customer = Customers::findByHashId($id);
        $this->customer = $customer;
        $this->pelanggan['no_sambungan'] = $customer->no_sambungan;
        $this->pelanggan['no_pelanggan'] = $customer->no_pelanggan ?: ('CST'.$customer->no_sambungan);
        $this->pelanggan['nama_pelanggan'] = $customer->nama_pelanggan;
        $this->pelanggan['alamat_pelanggan'] = $customer->alamat_pelanggan;
        $this->pelanggan['zona_id'] = $customer->zona_id;
        $this->pelanggan['golongan_id'] = $customer->golongan_id;
        $this->pelanggan['bulan_langganan'] = $customer->bulan_langganan;
        $this->pelanggan['tahun_langganan'] = $customer->tahun_langganan;
        $this->pelanggan['status_pelanggan'] = $customer->status_pelanggan;
        $this->pelanggan['penagihan_pelanggan'] = $customer->penagihan_pelanggan;
        $this->pelanggan['is_valid'] = $customer->is_valid;
        $this->pelanggan['keterangan'] = $customer->keterangan;
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function resetForms(): void
    {
        $this->reset('pelanggan');
    }

    public function buatDanKembali(): void
    {
        $this->submit();
        $this->redirectRoute('master.pelanggan.list');
    }

    public function submit(): void
    {
        if ($this->customer->update($this->pelanggan)) {
            $this->alert('success', 'Berhasil mengubah pelanggan');
        } else {
            $this->alert('error', 'Gagal mengubah pelanggan');
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

        return view('livewire.master.pelanggan.edit-pelanggan', compact('pageData'));
    }
}
