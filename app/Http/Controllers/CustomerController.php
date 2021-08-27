<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerValidationRequest;
use App\Models\Customer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        return view('customers.index');
    }

    public function show(Customer $customer): View
    {
        return view('customers.show', compact('customer'));
    }
}
