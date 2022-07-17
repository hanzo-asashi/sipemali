<?php

namespace App\Http\Livewire\Laporan;

use App\Models\GolonganTarif;
use App\Models\Zone;
use Livewire\Component;

class FormRekeningDitagih extends Component
{
    public function render()
    {
        $listZona = Zone::pluck('wilayah', 'kode');
        $listGolongan = GolonganTarif::pluck('nama_golongan', 'kode_golongan');

        return view('livewire.laporan.form-rekening-ditagih', compact('listZona', 'listGolongan'));
    }
}
