<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['components.navigation', 'components.admin-navigation', 'components.user-panel-navigation'], function($view) {
            if ($view->getName() != 'layouts.maintenance') {
                $navigation = collect(json_decode(Storage::disk('local')->get('navigation.json'), false));
                $admin_navigation = collect(json_decode(Storage::disk('local')->get('admin_navigation.json'), false));
                $usercp_navigation = collect(json_decode(Storage::disk('local')->get('usercp_navigation.json'), false));
                $view->with('navigation', $navigation)->with('admin_navigation', $admin_navigation)->with('usercp_navigation', $usercp_navigation);
            }
        });
    }
}
