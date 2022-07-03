<?php
namespace App\Concerns;

use Illuminate\Support\Str;
use Livewire\WithPagination;

trait HasBulkAction
{
    use WithPagination;
    protected string $paginationTheme = 'bootstrap';

    public string $search = '';
    public int $perPage = 10;
    public string $orderBy = 'id';
    public string $direction = 'asc';
    public string $defaultSortBy = 'id';

    public array $pageData = [];
    public array $checked = [];
    public bool $isChecked = false;
    public bool $selectAll = false;
    public bool $updateMode = false;
    public bool $selectAllAlamat = false;
    public string $title = '';

    public array $selectedRows = [];
    public $rows;
    public string $model = '';

    public function mount($model)
    {
        $this->model = $model;
        $this->title = Str::plural(class_basename($model));
    }

    public function bulkAction($action)
    {
        $this->$action(collect($this->selectedRows)->pluck('id'));
        $this->selectedRows = [];
    }

    public function selectAll()
    {
        $this->selectedRows = $this->rows->pluck('id')->toArray();
    }

    public function selectNone()
    {
        $this->selectedRows = [];
    }

    public function selectInvert()
    {
        $this->selectedRows = $this->rows->pluck('id')->diff($this->selectedRows)->toArray();
    }

    public function selectRows($rows)
    {
        $this->selectedRows = $rows;
    }

    public function getSelectedRows()
    {
        return $this->selectedRows;
    }

    public function getSelectedRowsCount(): int
    {
        return count($this->selectedRows);
    }

    public function getSelectedRowsCountText(): string
    {
        return $this->getSelectedRowsCount() . ' ' . Str::plural('row', $this->getSelectedRowsCount());
    }

    public function getSelectedRowsText(): string
    {
        return implode(', ', $this->selectedRows);
    }

    public function getSelectedRowsTextWithCount(): string
    {
        return $this->getSelectedRowsCountText() . ' selected';
    }

    public function getSelectedRowsTextWithCountAndIds(): string
    {
        return $this->getSelectedRowsTextWithCount() . ' (ids: ' . $this->getSelectedRowsText() . ')';
    }

    public function isChecked($id): bool
    {
        return in_array($id, $this->checked);
    }

    public function selectAllData()
    {
        $this->selectAllAlamat = true;
        $this->checked = $this->address->pluck('id')->toArray();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = $this->address->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
            $this->selectAllAlamat = false;
        }
    }

    public function alert($options = false, $event = 'notifikasi')
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent($event, $options);
    }

    public function sendNotifikasi($model, $event = 'notifikasi')
    {
        if ($model) {
            $this->alert([
                'type' => 'success',
                'title' => 'Berhasil!!',
                'message' => 'Data berhasil disimpan'
            ], $event);
        } else {
            $this->alert([
                'type' => 'error',
                'title' => 'Gagal!!',
                'message' => 'Data gagal dihapus',
            ], $event);
        }
    }

}
