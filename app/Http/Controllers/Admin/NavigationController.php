<?php

namespace App\Http\Controllers\Admin;

use App\Models\Navigation;
use Illuminate\Contracts\View\View;
use App\Models\NavigationType;
use App\Http\Controllers\Controller;

class NavigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $parent_pages = Navigation::with('children')->where('navigation_type_id', 1)->orderBy('order_column')->get();
        $admin_parent_pages = Navigation::with('children')->where('navigation_type_id', 2)->orderBy('order_column')->get();
        $navigation_types = NavigationType::all();
        return view('admin.navigation', ['parent_pages' => $parent_pages, 'admin_pages' => $admin_parent_pages, 'navigation_types' => $navigation_types]);
    }
}
