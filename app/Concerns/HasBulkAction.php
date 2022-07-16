<?php

namespace App\Concerns;

trait HasBulkAction
{
    public bool $isChecked = false;
    public int $modelId;
    public array $selected = [];
    public int $selectedRow = 0;
    public array $selectedRows = [];
    public bool $selectAllRows = false;
    public $model;

    public function isChecked($id): bool
    {
        $this->setModelId($id);
        return in_array($id, $this->selectedRows, true);
    }

    public function selectAllData(): void
    {
        $this->selectAllRows = true;
        $this->selectedRows = $this->model->pluck('id')->toArray();
    }

    public function updatedSelectAllRows($value): void
    {
        if ($value) {
            $this->selectedRows = $this->model->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->selectAllRows = false;
            $this->selectedRows = [];
            $this->isChecked = false;
        }
    }

    public function resetSelectedRows(): void
    {
        $this->selectedRows = [];
        $this->selectAllRows = false;
    }

    public function getModelId(): int
    {
        return $this->modelId;
    }

    public function setModelId($id): void
    {
        $this->modelId = $id;
    }
}
