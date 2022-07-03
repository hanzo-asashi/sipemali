<?php

namespace App\Http\Livewire\ObjekPajak;

use App\Models\JenisBahanBakuMineral;
use App\Models\ObjekPajakTambangMineral;
use Debugbar;
use Livewire\Component;

class FormOpBahanBaku extends Component
{
    public $bahanBakuTambang = [
    ];
    public $allBahanBaku;
    public $jenisBahanBaku = [''];
    public $saved = false;
    public $objekPajakTambang;

    public $listeners = ['submitBahanBaku'];

    public function addBahanBakuTambang()
    {
        $this->bahanBakuTambang[] = ['id_jenis_bahan_baku' => '', 'volume' => 0];
    }

    public function submitBahanBaku($objek)
    {
        $objekPajakTambang = ObjekPajakTambangMineral::create($objek);
        foreach ($this->bahanBakuTambang as $item) {
            $objekPajakTambang->bahanBakuTambang()->attach($item['nama'], ['jumlah_volume' => $item['volume']]);
        }
    }

    public function mount()
    {
        $this->allBahanBaku = JenisBahanBakuMineral::all();
        $this->bahanBakuTambang = [
            ['id_jenis_bahan_baku' => '', 'volume' => 0]
        ];
    }

    public function removeBahanBakuTambang($index)
    {
        unset($this->bahanBakuTambang[$index]);
       $this->bahanBakuTambang = array_values($this->bahanBakuTambang);
    }

    public function updatedBahanBakuTambang($key, $value)
    {
        $this->saved = false;
        $parts = explode('.', $value);
        if (count($parts) == 2 && $parts[1] === 'nama') {
            $jenisBahanBaku = $this->allBahanBaku->where('id', $key)->first();
            if ($jenisBahanBaku) {
                $this->bahanBakuTambang[$parts[0]][$parts[1]] = $jenisBahanBaku->id;
                $this->bahanBakuTambang[$parts[0]]['satuan'] = $jenisBahanBaku->satuan;
                $this->bahanBakuTambang[$parts[0]]['nilai'] = $jenisBahanBaku->nilai;
            }
        }
    }

    public function render()
    {
        Debugbar::info($this->bahanBakuTambang);
        $listBahanBaku = JenisBahanBakuMineral::pluck('nama','id');
        return view('livewire.objek-pajak.form-op-bahan-baku', compact('listBahanBaku'));
    }
}
