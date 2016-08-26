<?php

namespace App\Tools;

use App;

class ThemeManager
{
    protected $theme = 'default';

    public function setTheme($name) {
        $this->theme = $name;
    }

    public function view($view) {
        return 'themes.' . $this->theme . $view;
    }
}

function theme($view = null) {
    $theme = App::make(ThemeManager::class);
    $view = is_null($view) ? $theme : $theme->view($view);
}