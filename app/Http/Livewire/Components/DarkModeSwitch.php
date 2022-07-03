<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class DarkModeSwitch extends Component
{
    const LAYOUT_LIGHT ='layout-mode-light';
    const LAYOUT_DARK ='layout-mode-dark';
    const LAYOUT_ICON_DARK = 'moon';
    const LAYOUT_ICON_LIGHT = 'sun';

    public $layout;
    public $icon;
    public bool $toogle = false;
    public string $sidebar;
    public string $topbar;
    public string $layoutApp;
    public string $theme = 'light';

    public function mount()
    {
//        $this->sidebar = setting('tema_sidebar');
//        $this->topbar = setting('tema_topbar');
//        $this->layoutApp = setting('tema_layout');
//
//        if($this->theme === 'light'){
//            $this->layout = self::LAYOUT_LIGHT;
//            $this->icon = self::LAYOUT_ICON_LIGHT;
//        }else{
//            $this->layout = self::LAYOUT_DARK;
//            $this->icon = self::LAYOUT_ICON_DARK;
//        }

    }

    public function switchDarkMode()
    {
        $this->toogle = true;
        $this->theme = 'dark';
    }

    private function simpanSetting($data)
    {
        if(is_array($data)){
            foreach ($data as $key => $item) {
                setting()->set($key,$item);
            }
        }
        setting()->set($data, $data);
    }

    public function updatedSwitchDarkMode()
    {
        if($this->toogle && $this->theme === 'dark'){
            $this->sidebar = 'dark';
            $this->topbar = 'dark';
            $this->layoutApp = 'dark';
            $this->layout = self::LAYOUT_DARK;
            $this->icon = self::LAYOUT_ICON_DARK;
        }else{
            $this->sidebar = 'light';
            $this->topbar = 'light';
            $this->layoutApp = 'light';
            $this->layout = self::LAYOUT_LIGHT;
            $this->icon = self::LAYOUT_ICON_LIGHT;
        }

        $tema = [
            'tema_sidebar' => $this->sidebar,
            'tema_topbar' => $this->sidebar,
            'tema_layout' => $this->layoutApp,
        ];

        $this->simpanSetting($tema);
    }
    public function render()
    {
        return view('livewire.components.dark-mode-switch');
    }
}
