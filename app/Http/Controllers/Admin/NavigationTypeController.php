<?php

namespace App\Http\Controllers\Admin;

use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Models\NavigationType;
use App\Http\Controllers\Controller;

class NavigationTypeController extends Controller
{
    public function index(NavigationType $navigationType)
    {
        $navigations = Navigation::where('navigation_type_id', $navigationType->id)->get()->toArray();
        return response()->json($navigations);
    }
}
