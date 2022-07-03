<?php

namespace App\Http\Livewire\Master\JenisWajibPajak;

use App\Models\JenisWajibPajak;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class JenisWpTable extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public $jenisWajibPajak;
    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'nama_jenis_wp';
    public int $perPage = 10;
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    public bool $showEditModal = false;

    public $nama_jenis_wp;
    public $listeners = [];

    protected function rules()
    {
        return [
            'nama_jenis_wp' => 'required|unique:jenis_wajib_pajak,nama_jenis_wp',
        ];
    }

    public function add()
    {
        $this->showEditModal = false;
        $this->resetInput();
    }

    public function edit(JenisWajibPajak $jenisWajibPajak)
    {
        $this->showEditModal = true;
        $this->nama_jenis_wp = $jenisWajibPajak->nama_jenis_wp;
        $this->jenisWajibPajak = $jenisWajibPajak;
    }

    private function resetInput()
    {
        $this->reset('nama_jenis_wp');
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

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function createJenisPajak()
    {
        $data = ['success' => 'false', 'message' => 'Jenis Wajib Pajak gagal di tambahkan'];
        $validatedData = $this->validate();

        $create = JenisWajibPajak::create($validatedData);
        if ($create) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Jenis Wajib Pajak berhasil ditambahkan';
        }else{
            $this->resetInput();
            $data['success'] = false;
            $data['message'] = 'Jenis Wajib Pajak gagal ditambahkan';
        }

        $this->alert($data);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateJenisPajak()
    {
        $data = ['success' => false, 'message' => 'Jenis Wajib Pajak gagal di perbaharui'];
        $validatedData = $this->validate([
            'nama_jenis_wp' => 'required',
        ]);

        $update = $this->jenisWajibPajak->update($validatedData);

        if ($update) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Jenis Wajib Pajak berhasil di perbaharui';
            $this->showEditModal = false;
        }else{
            $this->resetInput();
            $data['success'] = false;
            $data['message'] = 'Jenis Wajib Pajak gagal di perbaharui';
            $this->showEditModal = false;
        }

        $this->alert($data);
    }

    public function delete($id, $tipe): ?bool
    {
//    $this->authorize('delete', $this->checked);
        if ($tipe === 'bulk') {
            $user = JenisWajibPajak::whereKey($this->checked)->delete();
            $this->checked = [];
            session()->flash('message', 'Jenis Wajib Pajak berhasil dihapus.');

            return $user;
        } else {
            session()->flash('message', 'Jenis Wajib Pajak berhasil dihapus.');

            return JenisWajibPajak::findOrFail($id)->delete();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = JenisWajibPajak::query()
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
        $jenisWp = JenisWajibPajak::search(trim($this->search))
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);

        return view('livewire.master.jenis-wajib-pajak.jenis-wp-table', compact('jenisWp'));
    }
}
