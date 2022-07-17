<?php

namespace App\Http\Livewire\Master\TargetPajak;

use App\Models\JenisObjekPajak;
use App\Models\TargetPajak as Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public $targetPajak;

    public bool $filter = false;

    public bool $sort = false;

    public string $defaultSort = 'id';

    public int $perPage = 10;

    public string $search = '';

    public array $checked = [];

    public bool $isChecked = false;

    public string $cardTitle = 'List Target Pajak';

    public bool $selectAll = false;

    public bool $bulkDisabled = true;

    public bool $showEditModal = false;

    public $tahun_pajak;

    public $id_jenis_objek_pajak;

    public $target;

    protected $rules = [
        'tahun_pajak' => 'required|date_format:Y',
        'id_jenis_objek_pajak' => 'required',
        'target' => 'required',
    ];

    protected $validationAttributes = [
        'id_jenis_objek_pajak' => 'jenis objek pajak',
    ];

    public function mount()
    {
        $this->tahun_pajak = setting('tahun_sppt');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function add()
    {
        $this->showEditModal = false;
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->reset('target', 'id_jenis_objek_pajak');
    }

    public function edit(Model $targetPajak)
    {
        $this->showEditModal = true;
        $this->tahun_pajak = $targetPajak->tahun_pajak;
        $this->target = $targetPajak->target;
        $this->id_jenis_objek_pajak = $targetPajak->id_jenis_objek_pajak;
        $this->targetPajak = $targetPajak;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createTargetPajak()
    {
        $data = ['success' => 'false', 'message' => 'Target Pajak gagal di tambahkan'];
        $validatedData = $this->validate();

        $create = Model::create($validatedData);
        if ($create) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Target Pajak berhasil ditambahkan';
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

    public function updateTargetPajak()
    {
        $data = ['success' => false, 'message' => 'Target Pajak gagal di perbaharui'];
        $validatedData = $this->validate([
            'tahun_pajak' => 'date_format:Y',
            'id_jenis_objek_pajak' => 'required',
            'target' => 'required',
        ]);

        $update = $this->targetPajak->update($validatedData);

        if ($update) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Target Pajak berhasil di perbaharui';
            $this->showEditModal = false;
        }

        $this->alert($data);
    }

    public function delete($id, $tipe): ?bool
    {
//    $this->authorize('delete', $this->checked);
        if ($tipe === 'bulk') {
            $user = Model::whereKey($this->checked)->delete();
            $this->checked = [];

            return $user;
        } else {
            return Model::findOrFail($id)->delete();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = Model::query()
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
        $listTargetPajak = Model::with(['jenisObjekPajak'])->search(trim($this->search))
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);
        $listJenisObjekPajak = JenisObjekPajak::pluck('nama_jenis_op', 'id');

        return view('livewire.master.target-pajak.table', compact('listTargetPajak', 'listJenisObjekPajak'));
    }
}
