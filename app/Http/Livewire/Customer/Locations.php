<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\CustomerLocation;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Locations extends Component
{
    public Customer $customer;
    public $delete_location_id;

    public $listeners = [
        'customerShowRefresh' => '$refresh',
        'confirmedDeleteLocation',
        'cancelledLocationDelete',
    ];

    public function render(): View
    {
        return view('livewire.customer.locations');
    }

    public function triggerLocationDelete($delete_id): void
    {
        $this->delete_location_id = $delete_id;
        self::confirm('Confirm Delete', [
            'text' => 'Are you sure you want to delete this location?',
            'onConfirmed' => 'confirmedDeleteLocation',
            'onCancelled' => 'cancelledLocationDelete',
        ]);
    }

    public function confirmedDeleteLocation(): void
    {
        CustomerLocation::findOrFail($this->delete_location_id)->delete();
        if ($this->customer->default_address === $this->delete_location_id) {
            $this->customer->default_address = 0;
        }
        if ($this->customer->shipping_address === $this->delete_location_id) {
            $this->customer->shipping_address = 0;
        }
        if ($this->customer->billing_address === $this->delete_location_id) {
            $this->customer->billing_address = 0;
        }
        $this->customer->save();
//        $this->emit('customerShowRefresh');
        self::alertPreset('success', 'Address deleted!');
    }

    public function cancelledLocationDelete(): void
    {
        self::alertPreset('toast', 'info', 'Location was not deleted.');
    }

    public function setDefault($id, $type, $column): void
    {
        $model = match ($type) {
            'location' => CustomerLocation::findOrFail($id),
            'contact' => CustomerContact::findOrFail($id),
        };
        switch ($column) {
            case 'default_address':
                $this->customer->default_address = $model->id;
                $message = 'Primary address updated!';
                break;
            case 'shipping_address':
                $this->customer->shipping_address = $model->id;
                $message = 'Shipping address updated!';
                break;
            case 'billing_address':
                $this->customer->billing_address = $model->id;
                $message = 'Billing address updated!';
                break;
            case 'primary_contact':
                $this->customer->primary_contact = $model->id;
                $message = 'Primary contact updated!';
                break;
        }
        $this->customer->save();
        $this->emit('customerShowRefresh');
        self::alert('success', $message);
    }
}
