<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\CustomerLocation;
use Livewire\Component;

class ShowCustomer extends Component
{
    public Customer $customer;
    public mixed $delete_location_id;

    public $listeners = [
        'customerShowRefresh' => '$refresh',
        'confirmedDeleteLocation',
        'confirmedDelete',
        'cancelledDelete',
        'cancelledLocationDelete'
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

    public function triggerDelete(): void
    {
        $this->confirm('Are you sure you want to delete?', [
            'onConfirmed' => 'confirmedDelete',
            'onCancelled' => 'cancelledDelete'
        ]);
    }

    public function confirmedDelete(): void
    {
        $this->customer->delete();
        $this->alert(
            'success',
            'Location deleted!'
        );
        $this->redirectRoute('customers.index');
    }

    public function confirmedDeleteLocation(): void
    {
        CustomerLocation::findOrFail($this->delete_location_id)->delete();
        if ($this->customer->default_address === $this->delete_location_id)
        {
            $this->customer->default_address = 0;
            $this->customer->save();
        }
        if ($this->customer->shipping_address === $this->delete_location_id)
        {
            $this->customer->shipping_address = 0;
            $this->customer->save();
        }
        if ($this->customer->billing_address === $this->delete_location_id)
        {
            $this->customer->billing_address = 0;
            $this->customer->save();
        }
        $this->emit('customerShowRefresh');
        $this->alert(
            'success',
            'Location deleted!'
        );
    }

    public function cancelledDelete(): void
    {
        $this->alert('info', 'Customer was not deleted.');
    }

    public function cancelledLocationDelete(): void
    {
        $this->alert('info', 'Location was not deleted.');
    }

    public function setDefault($id, $type, $column)
    {
        $model = match ($type) {
            'location' => CustomerLocation::findOrFail($id),
            'contact' => CustomerContact::findOrFail($id),
        };

        switch($column)
        {
            case 'default_address':
                $this->customer->default_address = $model->id;
                break;
            case 'shipping_address':
                $this->customer->shipping_address = $model->id;
                break;
            case 'billing_address':
                $this->customer->billing_address = $model->id;
                break;
            case 'primary_contact':
                $this->customer->primary_contact = $model->id;
                break;
        }

    }

    public function setDefaultAddress($locationId)
    {
        $location = CustomerLocation::findOrFail($locationId);
        $this->customer->default_address = $location->id;
        $this->customer->save();
        $this->emit('customerShowRefresh');
        $this->alert(
            'success',
            'Location set as default address!'
        );
    }

    public function setBillingAddress($locationId)
    {
        $location = CustomerLocation::findOrFail($locationId);
        $this->customer->billing_address = $location->id;
        $this->customer->save();
        $this->emit('customerShowRefresh');
        $this->alert(
            'success',
            'Location set as billing address!'
        );
    }

    public function setShippingAddress($locationId)
    {
        $location = CustomerLocation::findOrFail($locationId);
        $this->customer->shipping_address = $location->id;
        $this->customer->save();
        $this->emit('customerShowRefresh');
        $this->alert(
            'success',
            'Location set as shipping address !'
        );
    }
}
