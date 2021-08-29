<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CustomerIndexController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('customers.index');
    }
}
