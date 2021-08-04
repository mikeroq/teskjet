<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;

class ShowCustomer extends Component
{
    public $customer;
    public $listeners = ['customerShowRefresh' => 'render'];

    public function render()
    {
        return view('livewire.customer.show-customer');
    }
}
