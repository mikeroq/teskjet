<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class UserControlPanelController extends Controller
{
    public function showSecurity(): View
    {
        return view('profile.security')->with('user', Auth::user());
    }
}
