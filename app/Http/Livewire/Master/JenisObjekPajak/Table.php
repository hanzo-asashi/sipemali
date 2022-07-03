<?php

namespace App\Http\Livewire\Master\JenisObjekPajak;

use App\Models\JenisObjekPajak;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $jenisObjekPajak;
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
    public int $maxObjekPajak = 5;

    //Model Attributes
    public $nama_jenis_op;
    public $no_rekening;
    public $shortcode;

    protected string $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'nama_jenis_op' => 'required|unique:jenis_objek_pajak,nama_jenis_op',
            'no_rekening' => 'required|unique:jenis_objek_pajak,no_rekening',
            'shortcode' => 'required|unique:jenis_objek_pajak,shortcode',
        ];
    }

    public function add()
    {
        $this->showEditModal = false;
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->reset('nama_jenis_op', 'no_rekening', 'shortcode');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function edit(JenisObjekPajak $jenisObjekPajak)
    {
        $this->showEditModal = true;
        $this->nama_jenis_op = $jenisObjekPajak->nama_jenis_op;
        $this->no_rekening = $jenisObjekPajak->no_rekening;
        $this->shortcode = $jenisObjekPajak->shortcode;
        $this->jenisObjekPajak = $jenisObjekPajak;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createJenisObjekPajak()
    {
        $data = ['success' => false, 'message' => 'Jenis objek pajak gagal di tambahkan'];
        $validatedData = $this->validate();

        $create = JenisObjekPajak::create($validatedData);
        if ($create) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Jenis Objek Pajak berhasil ditambahkan';
        }

        $this->alert($data);
    }

    private function alert($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('alert', $options);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateJenisObjekPajak()
    {
        $data = ['success' => false, 'message' => 'Jenis Objek Pajak gagal di perbaharui'];
        $validatedData = $this->validate([
            'nama_jenis_op' => 'required',
            'no_rekening' => 'string',
            'shortcode' => 'required',
        ]);

        $update = $this->jenisObjekPajak->update($validatedData);

        if ($update) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Jenis Objek Pajak berhasil di perbaharui';
        }

        $this->showEditModal = false;
        $this->alert($data);
    }

    public function delete($id, $tipe): ?bool
    {
    $this->authorize('delete jenis-objek-pajak', $this->checked);
        if ($tipe === 'bulk') {
            $user = JenisObjekPajak::whereKey($this->checked)->delete();
            $this->checked = [];
            session()->flash('message', 'Jenis Objek Pajak berhasil dihapus.');

            return $user;
        } else {
            session()->flash('message', 'Jenis Objek Pajak berhasil dihapus.');

            return JenisObjekPajak::findOrFail($id)->delete();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = JenisObjekPajak::query()
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
        $jenisOp = JenisObjekPajak::search(trim($this->search))
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);

        return view('livewire.master.jenis-objek-pajak.table', compact('jenisOp'));
    }

}
