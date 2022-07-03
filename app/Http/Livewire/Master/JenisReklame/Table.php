<?php

namespace App\Http\Livewire\Master\JenisReklame;

use App\Models\JenisReklame;
use App\Models\JenisTarif;
use App\Models\TipeSatuan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public $jenisReklame;
    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'nama_jenis_op';
    public int $perPage = 10;
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    public bool $showEditModal = false;
    public array $periodePembayaran = [];

    public $nama_jenis_op;
    public $periode_pembayaran;
    public $nilai_strategis;
    public $nilai_jual_objek_pajak;
    public $tipe_satuan;
    public $jenis_tarif;

    public $listeners = [];

    protected function rules()
    {
        return [
            'nama_jenis_op'          => 'required|unique:jenis_reklame,nama_jenis_op',
            'periode_pembayaran'     => 'required',
            'nilai_strategis'        => 'required',
            'nilai_jual_objek_pajak' => 'required',
            'tipe_satuan'            => 'required',
            'jenis_tarif'            => 'required',
        ];
    }

    public function mount()
    {
        $this->periodePembayaran = config('custom.array-data.periode_pembayaran');
    }

    public function add()
    {
        $this->showEditModal = false;
        $this->resetInput();
    }

    public function edit(JenisReklame $jenisReklame)
    {
        $this->showEditModal = true;
        $this->nama_jenis_op = $jenisReklame->nama_jenis_op;
        $this->periode_pembayaran = $jenisReklame->periode_pembayaran;
        $this->nilai_strategis = $jenisReklame->nilai_strategis;
        $this->nilai_jual_objek_pajak = $jenisReklame->nilai_jual_objek_pajak;
        $this->tipe_satuan = $jenisReklame->tipe_satuan;
        $this->jenis_tarif = $jenisReklame->jenis_tarif;
        $this->jenisReklame = $jenisReklame;
    }

    private function resetInput()
    {
        $this->reset(
            'nama_jenis_op',
            'periode_pembayaran',
            'nilai_strategis',
            'nilai_jual_objek_pajak',
            'tipe_satuan',
            'jenis_tarif'
        );
    }

    private function alert($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('alert', $options);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createJenisReklame()
    {
        $data = ['success' => 'false', 'message' => 'Jenis Reklame gagal di tambahkan'];
        $validatedData = $this->validate();

        $create = JenisReklame::create($validatedData);
        if ($create) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Jenis Reklame berhasil ditambahkan';
        }

        $this->alert($data);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateJenisReklame()
    {
        $data = ['success' => false, 'message' => 'Jenis Reklame gagal di perbaharui'];
        $validatedData = $this->validate([
            'nama_jenis_op'          => 'required',
            'periode_pembayaran'     => 'required',
            'nilai_strategis'        => 'required',
            'nilai_jual_objek_pajak' => 'required',
            'tipe_satuan'            => 'required',
            'jenis_tarif'            => 'required',
        ]);

        $update = $this->jenisReklame->update($validatedData);

        if ($update) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Jenis Reklame berhasil di perbaharui';
            $this->showEditModal = false;
        }

        $this->alert($data);
    }

    public function delete($id, $tipe): ?bool
    {
        if ($tipe === 'bulk') {
            $user = JenisReklame::whereKey($this->checked)->delete();
            $this->checked = [];
            session()->flash('message', 'Jenis Reklame berhasil dihapus.');
            return $user;
        } else {
            session()->flash('message', 'Jenis Reklame berhasil dihapus.');
            return JenisReklame::findOrFail($id)->delete();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = JenisReklame::query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function isChecked($userid): bool
    {
        return in_array($userid, $this->checked);
    }

    public function render()
    {
        $listJenisReklame = JenisReklame::with(['tarif', 'satuan'])
            ->search(trim($this->search))
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);

        $listSatuan = TipeSatuan::pluck('satuan', 'id');
        $listTarif = JenisTarif::pluck('jenis', 'id');

        return view('livewire.master.jenis-reklame.table', compact(
            'listJenisReklame',
            'listSatuan',
            'listTarif',
        ));
    }
}
