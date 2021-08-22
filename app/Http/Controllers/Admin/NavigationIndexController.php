<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationType;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NavigationIndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return View
     */
    public function __invoke(): View
    {
        $navigation_types = NavigationType::all();
        return view('admin.navigation', ['navigation_types' => $navigation_types]);
    }
}
