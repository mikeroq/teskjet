<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserControlPanelController extends Controller
{
    public function showSecurity()
    {
        return view('profile.security')->with('user', Auth::user());
    }
}
