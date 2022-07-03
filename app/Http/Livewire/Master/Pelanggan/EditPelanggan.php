<?php

namespace App\Http\Livewire\Master\Pelanggan;

use App\Models\Customers;
use App\Models\GolonganTarif;
use App\Models\Status;
use App\Models\Zone;
use App\Utilities\Helpers;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditPelanggan extends Component
{
    use LivewireAlert;
    public Customers $customer;
    public array $pelanggan = [];

    public string $title = 'Ubah Pelanggan';

    public function mount(string $id)
    {
        $id = Helpers::decodeId($id);
        $customer = Customers::find($id);
        $this->customer = $customer;
        $this->pelanggan['no_sambungan'] = $customer->no_sambungan;
        $this->pelanggan['no_pelanggan'] = $customer->no_pelanggan;
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

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function resetForms()
    {
        $this->reset( 'pelanggan');
    }

    public function buatDanKembali()
    {
        $this->submit();
        $this->redirectRoute('master.pelanggan.list');
    }

    public function submit()
    {
        $update = $this->customer->update($this->pelanggan);

        if($update){
            $this->alert('success', 'Berhasil mengubah pelanggan');
        }else{
            $this->alert('error', 'Gagal mengubah pelanggan');
        }
    }

    public function render()
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

        return view('livewire.master.pelanggan.edit-pelanggan', compact('pageData'))->extends('layouts.contentLayoutMaster');
    }
}
