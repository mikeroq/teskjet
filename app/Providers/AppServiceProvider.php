<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Navigation;
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
                $navigation = Navigation::where('navigation_type_id', 1)->orderBy('order_column', 'ASC')->get();
                $admin_navigation = Navigation::where('navigation_type_id', 2)->orderBy('order_column', 'ASC')->get();
                $usercp_navigation = Navigation::where('navigation_type_id', 5)->orderBy('order_column', 'ASC')->get();
                $view->with('navigation', $navigation)->with('admin_navigation', $admin_navigation)->with('usercp_navigation', $usercp_navigation);
            }
        });
    }
}
