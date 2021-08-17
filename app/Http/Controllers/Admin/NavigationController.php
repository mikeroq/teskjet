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
        $navigation_types = NavigationType::all();
        return view('admin.navigation', ['navigation_types' => $navigation_types]);
    }
}
