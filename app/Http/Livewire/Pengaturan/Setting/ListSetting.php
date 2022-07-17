<?php

namespace App\Http\Livewire\Pengaturan\Setting;

use App\Models\Setting;
use App\Utilities\Helpers;
use Config;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ListSetting extends Component
{
    use LivewireAlert;

    public string $title = 'Pengaturan';

    public array $state = [];

    public array $listBulan = [];

    public array $listMenuNavbarType = [];

    public array $listNavbarColor = [];

    public array $listFooterType = [];

    public array $listTheme = [];

    public array $listLanguage = [];
//    public bool $saved = false;

    /**
     * Prepare the component.
     */
    public function mount()
    {
        $this->state = $this->setting;
        $this->listBulan = config('custom.list_bulan');

        // options[String]: 'light'(default), 'dark', 'bordered', 'semi-dark'
        $this->listTheme = [
            'dark' => 'Dark',
            'light' => 'Light',
            'bordered' => 'Bordered',
            'semi-dark' => 'Semi-Dark',
        ];

        // floating(default) / static / sticky / hidden
        $this->listMenuNavbarType = [
            'floating' => 'Floating',
            'static' => 'Static',
            'sticky' => 'Sticky',
            'hidden' => 'Hidden',
        ];

        // bg-primary, bg-info, bg-warning, bg-success, bg-danger, bg-dark
        $this->listNavbarColor = [
            'bg-primary' => 'Primary',
            'bg-info' => 'Info',
            'bg-warning' => 'Warning',
            'bg-success' => 'Success',
            'bg-danger' => 'Danger',
            'bg-dark' => 'Dark',
        ];

        // static(default) / sticky / hidden
        $this->listFooterType = [
            'static' => 'Static',
            'sticky' => 'Sticky',
            'hidden' => 'Hidden',
        ];

        $this->state['bulan'] = now()->month;
        $this->state['tahun_periode'] = now()->year;
        $this->state['tarif_denda'] = 20000;
        $this->state['footerType'] = 'static';
        $this->state['verticalMenuNavbarType'] = 'floating';
        $this->state['navbarColor'] = 'floating';
        $this->state['penandatangan'] = 'ISI NAMA PEJABAT';
        $this->state['nama_aplikasi'] = 'e-PDAM';
        $this->state['nama_kantor'] = 'PERUSAHAAN DAERAH AIR MINUM KABUPATEN SOPPENG';
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getSettingProperty()
    {
        return Setting::pluck('value', 'key')->toArray();
    }

    public function updatedStateDarkmode($value)
    {
        $value = $value ? 'dark' : 'light';
        $this->enabledDarkMode($value);
    }

    public function updatedStateSidebarcollapsed($value)
    {
        $value = (bool) $value;
        $this->enabledSidebarCollapsed($value);
    }

    public function enabledDarkMode($value)
    {
        $this->state['theme'] = $value;
        setting()->set('theme', $value);
        Config::set('custom.custom.theme', $value);
    }

    public function enabledSidebarCollapsed(bool $value)
    {
        $this->state['sidebarcollapsed'] = $value;
        setting()->set('sidebarcollapsed', $value);
        Config::set('custom.custom.sidebarCollapsed', $value);
    }

    public function submit()
    {
        $pageConfigs = [
            'sidebarCollapse' => $this->state['sidebarcollapsed'],
            'theme' => $this->state['theme'],
            'verticalMenuNavbarType' => $this->state['verticalMenuNavbarType'],
            'navbarColor' => $this->state['navbarColor'],
            'footerType' => $this->state['footerType'],
        ];

        foreach ($this->state as $key => $item) {
            setting()->set($key, $item);
        }

        Helpers::updatePageConfig($pageConfigs);

        $this->alert('success', 'Pengaturan berhasil di simpan');
//        $this->saved = true;
    }

    public function render()
    {
        return view('livewire.pengaturan.setting.list-setting')->extends('layouts.contentLayoutMaster');
    }
}
