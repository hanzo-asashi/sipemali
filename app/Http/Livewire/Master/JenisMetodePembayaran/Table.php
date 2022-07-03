<?php

namespace App\Http\Livewire\Master\JenisMetodePembayaran;

use App\Models\MetodeBayarPajak;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public $metodeBayar;
    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'jenis_metode';
    public int $perPage = 10;
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    public bool $showEditModal = false;

    public $jenis_metode;
    public $keterangan;
    public $listeners = [];

    protected function rules()
    {
        return [
            'jenis_metode' => 'required|unique:jenis_metode_pembayaran,jenis_metode',
            'keterangan'   => 'max:255',
        ];
    }

    public function add()
    {
        $this->showEditModal = false;
        $this->resetInput();
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function edit(MetodeBayarPajak $metodeBayar)
    {
        $this->showEditModal = true;
        $this->jenis_metode = $metodeBayar->jenis_metode;
        $this->keterangan = $metodeBayar->keterangan;
        $this->metodeBayar = $metodeBayar;
    }

    private function resetInput()
    {
        $this->reset('jenis_metode', 'keterangan');
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

    public function createMetodeBayar()
    {
        $data = ['success' => false, 'message' => 'Metode Pembayaran gagal di tambahkan'];
        $validatedData = $this->validate();

        $create = MetodeBayarPajak::create($validatedData);
        if ($create) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Metode Pembayaran berhasil ditambahkan';
        }

        $this->alert($data);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateMetodeBayar()
    {
        $data = ['success' => false, 'message' => 'Metode Pembayaran gagal di perbaharui'];
        $validatedData = $this->validate([
            'jenis_metode' => 'required',
            'keterangan'   => 'max:255',
        ]);

        $update = $this->metodeBayar->update($validatedData);

        if ($update) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Metode Pembayaran berhasil di perbaharui';
            $this->showEditModal = false;
        }

        $this->alert($data);
    }

    public function delete($id, $tipe): ?bool
    {
//    $this->authorize('delete', $this->checked);
        if ($tipe === 'bulk') {
            $user = MetodeBayarPajak::whereKey($this->checked)->delete();
            $this->checked = [];
            session()->flash('message', 'Jenis Wajib Pajak berhasil dihapus.');

            return $user;
        } else {
            session()->flash('message', 'Jenis Wajib Pajak berhasil dihapus.');

            return MetodeBayarPajak::findOrFail($id)->delete();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = MetodeBayarPajak::query()
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
        $listMetodeByr = MetodeBayarPajak::search(trim($this->search))
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);

        return view('livewire.master.jenis-metode-pembayaran.table', compact('listMetodeByr'));
    }
}
