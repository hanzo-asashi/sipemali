<?php

namespace App\Concerns;

trait WithTitle
{
    public string $title = '';

    public array $breadcrumbs = [];

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getBreadcrumbs(): array
    {
        return $this->breadcrumbs;
    }

    public function setBreadcrumbs($breadcrumbs): void
    {
        $this->breadcrumbs = $breadcrumbs;
    }
}
