<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use url;
class SettingsComposer
{
    public function compose(View $view)
    {
        $view->with('settings', getSettings());
    }
}