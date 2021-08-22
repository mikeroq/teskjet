<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CustomerLocation;
use Illuminate\Http\RedirectResponse;

class RedirectLocationController extends
    Controller
{
    public function __invoke(CustomerLocation $customerLocation): RedirectResponse
    {
        return redirect()->route('customers.show', $customerLocation->customer->id. '#addresses');
    }
}