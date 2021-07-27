<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NavigationType;
use App\Models\Navigation;

class NavigationTypeController extends Controller
{
    public function index(NavigationType $navigationType)
    {
        $navigations = Navigation::where('navigation_type_id', $navigationType->id)->get()->toArray();
        return response()->json($navigations);
    }
}
