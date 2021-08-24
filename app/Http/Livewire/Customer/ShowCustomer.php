<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShowCustomer extends Component
{
    public Customer $customer;

    public $listeners = [
        'customerShowRefresh' => '$refresh',
        'confirmedDeleteLocation',
        'confirmedDelete',
        'cancelledDelete',
        'cancelledLocationDelete'
    ];

    public function render(): View
    {
        return view('livewire.customer.show-customer');
    }



    public function triggerDelete(): void
    {
        self::confirm('Are you sure you want to delete?', [
            'onConfirmed' => 'confirmedDelete',
            'onCancelled' => 'cancelledDelete'
        ]);
    }

    public function confirmedDelete(): void
    {
        $this->customer->delete();
        self::alert(
            'success',
            'Location deleted!'
        );
        $this->redirectRoute('customers.index');
    }

    public function cancelledDelete(): void
    {
        self::alert('info', 'Customer was not deleted.');
    }
}
