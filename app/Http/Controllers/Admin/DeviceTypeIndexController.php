<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeviceTypeIndexController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.device-types');
    }
}
