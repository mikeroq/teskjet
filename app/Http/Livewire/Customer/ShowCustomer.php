<?php

namespace App\Http\Livewire\Customer;

use App\Models\CustomerLocation;
use Livewire\Component;

class ShowCustomer extends Component
{
    public $customer;
    public $delete_location_id;

    public $listeners = [
        'customerShowRefresh' => '$refresh',
        'confirmedDeleteLocation',
        'cancelledDelete'
    ];

    public function render()
    {
        return view('livewire.customer.show-customer');
    }

    public function triggerLocationDelete($delete_id): void
    {
        $this->delete_location_id = $delete_id;
        $this->confirm('Are you sure you want to delete?', [
            'onConfirmed' => 'confirmedDeleteLocation',
            'onCancelled' => 'cancelledDelete'
        ]);
    }

    public function confirmedDeleteLocation(): void
    {
        CustomerLocation::findOrFail($this->delete_location_id)->delete();
        $this->emit('customerShowRefresh');
        $this->alert(
            'success',
            'Location deleted!'
        );
    }

    public function cancelledDelete(): void
    {
        $this->alert('info', 'Location was not deleted.');
    }
}
