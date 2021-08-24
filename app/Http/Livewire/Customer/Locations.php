<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\CustomerLocation;
use Livewire\Component;

class Locations extends Component
{
    public Customer $customer;
    public mixed $delete_location_id;

    public $listeners = [
        'customerShowRefresh' => '$refresh',
        'confirmedDeleteLocation',
        'cancelledLocationDelete'
    ];

    public function render()
    {
        return view('livewire.customer.locations');
    }

    public function triggerLocationDelete($delete_id): void
    {
        $this->delete_location_id = $delete_id;
        self::confirm('Are you sure you want to delete?', [
            'onConfirmed' => 'confirmedDeleteLocation',
            'onCancelled' => 'cancelledDelete'
        ]);
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
        self::alert(
            'success',
            'Location deleted!'
        );
    }

    public function cancelledLocationDelete(): void
    {
        self::alert('info', 'Location was not deleted.');
    }

    public function setDefault($id, $type, $column): void
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

    public function setDefaultAddress($locationId): void
    {
        $location = CustomerLocation::findOrFail($locationId);
        $this->customer->default_address = $location->id;
        $this->customer->save();
        $this->emit('customerShowRefresh');
        self::alert(
            'success',
            'Location set as default address!'
        );
    }

    public function setBillingAddress($locationId): void
    {
        $location = CustomerLocation::findOrFail($locationId);
        $this->customer->billing_address = $location->id;
        $this->customer->save();
        $this->emit('customerShowRefresh');
        self::alert(
            'success',
            'Location set as billing address!'
        );
    }

    public function setShippingAddress($locationId): void
    {
        $location = CustomerLocation::findOrFail($locationId);
        $this->customer->shipping_address = $location->id;
        $this->customer->save();
        $this->emit('customerShowRefresh');
        self::alert(
            'success',
            'Location set as shipping address !'
        );
    }
}
