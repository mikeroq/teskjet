<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(['components.navigation', 'components.admin-navigation', 'components.user-panel-navigation'], function ($view) {
            if ($view->getName() !== 'layouts.maintenance') {
                $navigation = collect(json_decode(Storage::disk('local')->get('navigation.json'),
                    false,
                    512,
                    JSON_THROW_ON_ERROR));
                $admin_navigation = collect(json_decode(Storage::disk('local')->get('admin_navigation.json'),
                    false,
                    512,
                    JSON_THROW_ON_ERROR));
                $usercp_navigation = collect(json_decode(Storage::disk('local')->get('usercp_navigation.json'),
                    false,
                    512,
                    JSON_THROW_ON_ERROR));
                $view->with('navigation', $navigation)->with('admin_navigation', $admin_navigation)->with('usercp_navigation', $usercp_navigation);
            }
        });
    }
}
