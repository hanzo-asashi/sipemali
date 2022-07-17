<?php

namespace App\Concerns;

use Livewire\WithPagination;

trait HasGeneral
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';

    public int $perPage = 10;

    public string $orderBy = 'id';

    public string $direction = 'asc';

    public string $defaultSortBy = 'id';

    public array $pageData = [];

    public bool $updateMode = false;

    public string $title = '';

    public function __construct()
    {
    }
}
