<?php

namespace App\Http\Livewire\Components;

use App\Models\Wilayah;
use Livewire\Component;

class Select2Component extends Component
{
    public $kabupaten;
    public $kecamatan;
    public $kelurahan;

    public array $wil = [];

    public $selectedProvinsi = null;
    public $selectedKabupaten = null;
    public $selectedKecamatan = null;
    public $selectedKelurahan = null;
    public $selectedState;

    protected $rules = [
        'selectedKabupaten' => 'required',
        'selectedKecamatan' => 'required',
        'selectedKelurahan' => 'required',
    ];

    public function mount()
    {
        $this->wil = [
            2 => [5, 'Kota/Kabupaten', 'kab'],
            5 => [8, 'Kecamatan', 'kec'],
            8 => [13, 'Kelurahan', 'kel'],
        ];

        $this->selectedProvinsi = setting('kode_provinsi');
        $this->selectedKabupaten = setting('kode_kabupaten');
        $this->kabupaten = self::getWilayah($this->selectedProvinsi);

        if (!is_null($this->selectedKabupaten)) {
            $this->kecamatan = self::getWilayah($this->selectedKabupaten);
        } else {
            $this->kecamatan = collect();
        }

        $this->kelurahan = collect();
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function getWilayah($kode)
    {
        $n = strlen($kode);
        $length = in_array($n, $this->wil) ?: $this->wil[$n][0];

        return Wilayah::query()->whereRaw('LEFT(kode,'.$n.")='{$kode}'")
            ->whereRaw('CHAR_LENGTH(kode)='.$length)
            ->orderBy('nama')
            ->get();
    }

    public function updatedSelectedKabupaten($kabupaten)
    {
        if (!is_null($kabupaten)) {
            $this->kecamatan = self::getWilayah($kabupaten);
        }

        $this->selectedKabupaten = $kabupaten;
    }

    public function updatedSelectedKecamatan($kecamatan)
    {
        if (!is_null($kecamatan)) {
            $this->kelurahan = self::getWilayah($kecamatan);
        }
        $this->selectedKecamatan = $kecamatan;
    }

    public function render()
    {
        $listKabupaten = self::getWilayah($this->selectedProvinsi);

        return view('livewire.components.select2-component', compact('listKabupaten'));
    }
}
