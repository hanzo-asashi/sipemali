<?php

namespace App\Http\Livewire\WajibPajak;

use App\Models\WajibPajak;
use App\Models\WajibPajak as WajibPajakModel;
use App\Utilities\Helper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class TableIndex extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $wajibPajak;
    public $kecamatan;
    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'id';
    public int $perPage = 10;
    public bool $filterByStatus = false;
    public string $selectedKecamatan = '';
    public $selectedRows = [];
    public bool $selectPageRows = false;
    public string $search = '';
    public array $checked = [];
    public bool $isChecked = false;
    public string $cardTitle = 'Data Pengguna';
    public bool $selectAll = false;
    public bool $bulkDisabled = true;
    protected string $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(WajibPajakModel $wajibPajak)
    {
        $this->wajibPajak = $wajibPajak;
        $this->kecamatan = Helper::getWilayah(setting('kode_kabupaten'));
    }

    /**
     * @throws AuthorizationException
     */
    public function delete($id, $tipe): ?bool
    {
        $this->authorize('delete wajib-pajak', $this->checked);
        if ($tipe === 'bulk') {
//            $wajibPajak = $this->wajibPajak->whereKey($this->checked)->delete();
            $wajibPajak = $this->wajibPajak->with(['objekpajak','objekpajak.pembayaran'])->whereKey($this->checked)->get();
            $wajibPajak->each(function ($wajibPajak) {
                $wajibPajak->objekpajak->each(function ($objekpajak) {
                    $objekpajak->pembayaran->each(function ($pembayaran) {
                        $pembayaran->delete();
                    });
                    $objekpajak->delete();
                });
                $wajibPajak->delete();
            });
            $this->checked = [];
            return $wajibPajak;
        } else {
            $wajibPajak = $this->wajibPajak->with(['objekpajak','pembayaran','objekpajak.pembayaran'])->findOrFail($id);
            if(!is_null($wajibPajak) && !is_null($wajibPajak->objekpajak)){
                $wajibPajak->objekpajak->each(function ($objekpajak) {
                    $objekpajak->pembayaran->each(function ($pembayaran) {
                        $pembayaran->delete();
                    });
                    $objekpajak->delete();
                });
            }
            return $wajibPajak->delete();
        }
    }

    public function deleteAllSelectedRows()
    {
        $delete = $this->wajibPajak->whereKey($this->selectedRows)->delete();
        if ($delete) {
            $this->reset(['selectedRows', 'selectPageRows']);
            $this->dispatchBrowserEvent('alert', ['success' => true, 'message' => 'Semua baris terpilih berhasil di hapus.']);
        } else {
            $this->dispatchBrowserEvent('alert', ['success' => false, 'message' => 'Semua baris terpilih gagal di hapus.']);
        }
    }

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->wajibpajaks->pluck('id')->map(function ($id) {
                return (string) $id;
            });

        } else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = $this->wajibPajak->query()
                ->when($this->selectedKecamatan, function ($q) {
                    $q->where('kode', $this->selectedKecamatan);
                })
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function getWajibPajaksProperty()
    {
        return $this->wajibPajak
            ->with(['objekpajak','kab','kec','kel','objekpajak.pembayaran','objekpajak.pembayaran.tunggakan'])
            ->withCount(['objekpajak'])
            ->search(trim($this->search))
            ->when($this->selectedKecamatan, function ($q) {
                $q->where('kec', $this->selectedKecamatan);
            })
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);
    }

    public function isChecked($userid): bool
    {
        return in_array($userid, $this->checked);
    }

    public function render()
    {
        $listWajibPajak = $this->wajibpajaks;

        return view('livewire.wajib-pajak.table-index', compact('listWajibPajak'));
    }
}
