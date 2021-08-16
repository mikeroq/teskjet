<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show(User $user): View
    {
        return view('users.profile')->with(compact('user'));
    }
}
