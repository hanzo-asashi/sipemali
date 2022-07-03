<?php

namespace App\Http\Livewire;

use App\Utilities\Helpers;
use Livewire\Component;

class ToggleDarkMode extends Component
{
    public array $configData = [];
    public bool $darkMode = false;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function mount(string $data)
    {
        $data = $data === 'dark' ? 'sun' : 'moon';
        $this->configData['theme'] = $data;
    }

//    public function updatedDarkMode($value)
//    {
//        $this->configData['theme'] = $value ? 'moon' : 'sun';
//        $config = $value ? 'dark' : 'light';
//        \Config::set('custom.custom.theme', $config);
//    }

    public function toggleDarkMode()
    {
        $this->darkMode = ! $this->darkMode;
        $this->configData['theme'] = $this->darkMode ? 'moon' : 'sun';
        $config = $this->darkMode ? 'dark' : 'light';
        \Config::set('custom.custom.theme', $config);
        Helpers::updatePageConfig($this->configData);
    }

    public function render()
    {
        return view('livewire.toggle-dark-mode');
    }
}
