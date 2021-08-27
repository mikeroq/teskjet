<?php

/** @noinspection NullPointerExceptionInspection */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::User()->isAdmin()) {
            return $next($request);
        }

        return redirect('/login');
    }
}
