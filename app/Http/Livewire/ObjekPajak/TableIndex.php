<?php

namespace App\Http\Livewire\ObjekPajak;

use App\Models\JenisObjekPajak;
use App\Models\ObjekPajak;
use App\Utilities\Helper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class TableIndex extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $objekPajak;
//    public $kecamatan;
    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'nama_objek_pajak';
    public int $perPage = 10;
    public bool $filterByStatus = false;
    public string $selectedKecamatan = '';
    public string $selectedJenisObjekPajak = '';
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    protected string $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(ObjekPajak $objekPajak)
    {
        $this->objekPajak = $objekPajak;
    }

    /**
     * @throws AuthorizationException
     */
    public function delete($id, $tipe): ?bool
    {
        $this->authorize('delete objek-pajak', $this->checked);
        if ($tipe === 'bulk') {
            $objekPajak = $this->objekPajak->whereKey($this->checked)->delete();
            $this->checked = [];

            return $objekPajak;
        } else {
            return $this->objekPajak->findOrFail($id)->delete();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = $this->objekPajak->query()
                ->when($this->selectedKecamatan, function ($q) {
                    $q->where('kecamatan', $this->selectedKecamatan);
                })
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
        $listObjekPajak = $this->objekPajak->with(['jenisObjekPajak','kec','kel','wajibpajak'])
            ->search(trim($this->search))
            ->when($this->selectedKecamatan, function ($q) {
                $q->where('kecamatan', $this->selectedKecamatan);
            })
            ->when($this->selectedJenisObjekPajak, function ($q) {
                $q->where('id_jenis_op', $this->selectedJenisObjekPajak);
            })
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);

        $listJenisObjekPajak = JenisObjekPajak::pluck('nama_jenis_op','id');
        $listKecamatan = Helper::getWilayah(setting('kode_kabupaten'));

        return view('livewire.objek-pajak.table-index',
            compact('listObjekPajak','listJenisObjekPajak','listKecamatan'));
    }
}
