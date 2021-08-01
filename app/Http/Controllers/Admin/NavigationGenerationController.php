<?php

namespace App\Http\Controllers\Admin;

use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NavigationGenerationController extends Controller
{
    public function generate()
    {
        $navigation = Navigation::with('children')->where('navigation_type_id', 1)->orderBy('order_column', 'ASC')->get();
        $admin_navigation = Navigation::with('children')->where('navigation_type_id', 2)->orderBy('order_column', 'ASC')->get();
        $usercp_navigation = Navigation::with('children')->where('navigation_type_id', 5)->orderBy('order_column', 'ASC')->get();
        Storage::disk('local')->put('navigation.json', $navigation->toJson(JSON_UNESCAPED_SLASHES));
        Storage::disk('local')->put('admin_navigation.json', $admin_navigation->toJson(JSON_UNESCAPED_SLASHES));
        Storage::disk('local')->put('usercp_navigation.json', $usercp_navigation->toJson(JSON_UNESCAPED_SLASHES));
        // $nav = Storage::disk('local')->get('navigation.json');
        // $nav = json_decode($nav);
        // dd($nav);
    }
}
