<?php

namespace App\Http\Livewire\Pengaturan\Activity;

use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class ListActivity extends Component
{
    public string $title = 'Log Aktifitas';
    public int $perPage = 15;
    public int $page = 1;
    public string $search = '';

    public function render()
    {
        $logs = Activity::orderBy('created_at', 'desc')->paginate($this->perPage);

        $pageData = ['page' => $this->page, 'pageCount' => $this->perPage, 'totalData' => $logs->total(),'logs' => $logs];
        return view('livewire.pengaturan.activity.list-activity', $pageData)->extends('layouts.contentLayoutMaster');
    }
}
