<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LandingRedirectController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login');
    }
}
