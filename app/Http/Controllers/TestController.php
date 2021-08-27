<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view('test');
    }

    public function create(Request $request)
    {
        $request->validate([
            'phone' => 'phone:US',
        ],
        [
            'phone.phone' => 'Must be a valid phone number',
        ]);

        dd('passed');
    }
}
