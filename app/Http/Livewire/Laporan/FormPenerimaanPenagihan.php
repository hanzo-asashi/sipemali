<?php

namespace App\Http\Livewire\Laporan;

use App\Models\GolonganTarif;
use App\Models\Zone;
use Livewire\Component;

class FormPenerimaanPenagihan extends Component
{
    public bool $isChecked = false;

    public string $periodeCetak = '';

    public string $zonaWilayah = '';

    public function updatedZonaWilayah($value)
    {
        $this->zonaWilayah = (int) $value;
    }

    public function submitPilihan()
    {
        dd('pilihan');
    }

    public function submitPeriodePenjualan()
    {
        dd('periode penjualan');
    }

    public function submitPeriodePencetakan()
    {
        dd('periode pencetakan');
    }

    public function render()
    {
        $listZona = Zone::pluck('wilayah', 'kode');
        $listGolongan = GolonganTarif::pluck('nama_golongan', 'kode_golongan');

        return view('livewire.laporan.form-penerimaan-penagihan', compact('listZona', 'listGolongan'));
    }
}
