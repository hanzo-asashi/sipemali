<?php

namespace App\Http\Livewire\WajibPajak;

use App\Models\JenisWajibPajak;
use App\Models\WajibPajak;
use App\Utilities\Helper;
use Livewire\Component;

class CreateForm extends Component
{
    public $jenisWajibPajak;
    public $wajibPajak;

    public $selectedProvinsi;
    public $listKabupaten;
    public $listKecamatan;
    public $listKelurahan;

    public $id_jenis_wp;
    public $nama_wp;
    public $nik_nib;
    public $nwpd;
    public $kabupaten;
    public $kecamatan;
    public $kelurahan;
    public $alamat;
    public $telepon;
    public $email;
    public $idEditWp;
    public $success = false;
    public $message = '';
    public array $data = [];

    public bool $updateMode = false;

    public function mount(WajibPajak $wajibPajak)
    {
        $this->wajibPajak = $wajibPajak;
        $this->jenisWajibPajak = JenisWajibPajak::pluck('nama_jenis_wp', 'id');

        $this->selectedProvinsi = setting('kode_provinsi');
        $this->kabupaten = setting('kode_kabupaten');
        $this->listKabupaten = self::getWilayah($this->selectedProvinsi);

        if (!is_null($this->kabupaten)) {
            $this->listKecamatan = self::getWilayah($this->kabupaten);
        } else {
            $this->listKecamatan = collect();
        }

        $this->listKelurahan = collect();

        if ($this->updateMode) {
            $wpd = $this->wajibPajak->find($this->idEditWp);
            $this->id_jenis_wp = $wpd->id_jenis_wp;
            $this->nama_wp = $wpd->nama_wp;
            $this->nik_nib = $wpd->nik_nib;
            $this->nwpd = $wpd->nwpd;
            $this->kabupaten = $wpd->kabupaten;
            $this->kecamatan = $wpd->kecamatan;
            $this->kelurahan = $wpd->kelurahan;
            $this->alamat = $wpd->alamat;
            $this->telepon = $wpd->telepon;
            $this->email = $wpd->email;
            $this->listKelurahan = self::getWilayah($this->kecamatan);
        }
    }

    private function getWilayah($kode)
    {
        return Helper::getWilayah($kode);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function simpanTambahObjekPajak()
    {
        $validatedData = $this->_validationTambah();
        $wp = WajibPajak::create($validatedData);
        $this->_renderNotifikasi($wp);
        $this->clearForm();
        $this->resetValidation();
        $this->redirectRoute('objek-pajak.create',['wajib_pajak_id' =>$wp->id]);
    }

    private function _validationTambah($update = false): array
    {
        if (!$update) {
            return $this->validate([
                'id_jenis_wp' => 'required',
                'nama_wp' => 'required',
                'nik_nib' => 'required|max:16|unique:wajib_pajak,nik_nib',
                'nwpd' => 'required|unique:wajib_pajak,nwpd',
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'alamat' => 'required|max:255',
                'telepon' => 'required|unique:wajib_pajak,telepon',
                'email' => 'required|email|unique:wajib_pajak,email',
            ], [], [
                'id_jenis_wp' => 'jenis wajib pajak',
                'nama_wp' => 'nama wajib pajak',
                'nik_nib' => 'nik atau nib',
            ]);
        } else {
            return $this->validate([
                'id_jenis_wp' => 'required',
                'nama_wp' => 'required',
                'nik_nib' => 'required|max:16',
                'nwpd' => 'required',
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'alamat' => 'required|max:255',
                'telepon' => 'required',
                'email' => 'required|email',
            ], [], [
                'id_jenis_wp' => 'jenis wajib pajak',
                'nama_wp' => 'nama wajib pajak',
                'nik_nib' => 'nik atau nib',
            ]);
        }
    }

    public function submit()
    {
        $validatedData = $this->_validationTambah();
        $wp = WajibPajak::create($validatedData);
        $this->_renderNotifikasi($wp);
        $this->clearForm();
        $this->resetValidation();
    }

    private function _renderNotifikasi($wp, $update = false)
    {
        $message = $update ? 'diperbaharui' : 'ditambahkan';

        if ($wp) {
            $this->dispatchBrowserEvent('alert', [
                'success' => true,
                'message' => 'Wajib Pajak berhasil '.$message,
            ]);
        } else {
            $this->dispatchBrowserEvent('alert', [
                'success' => false,
                'message' => 'Wajib Pajak gagal '.$message,
            ]);
        }
    }

    public function updateWajibPajak()
    {
        $validatedData = $this->_validationTambah(true);
        $wp = $this->wajibPajak->find($this->idEditWp)->update($validatedData);
        $this->_renderNotifikasi($wp,true);
        $this->redirectRoute('wajib-pajak.index');
        $this->clearForm();
        $this->resetValidation();
    }

    public function clearForm()
    {
        $this->reset(['id_jenis_wp', 'nama_wp', 'nik_nib', 'nwpd', 'alamat', 'telepon', 'email']);
    }

    public function updatedKabupaten($kabupaten)
    {
        if (!is_null($kabupaten)) {
            $this->listKecamatan = self::getWilayah($kabupaten);
        }

        $this->kabupaten = $kabupaten;
    }

    public function updatedKecamatan($kecamatan)
    {
        if (!is_null($kecamatan)) {
            $this->listKelurahan = self::getWilayah($kecamatan);
        }
        $this->kecamatan = $kecamatan;
    }

    public function render()
    {
        $listKabupaten = self::getWilayah($this->selectedProvinsi);
        return view('livewire.wajib-pajak.create-form', compact('listKabupaten'));
    }
}
