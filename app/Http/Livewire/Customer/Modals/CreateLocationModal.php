<?php

namespace App\Http\Livewire\Customer\Modals;

use App\Models\Customer;
use App\Models\CustomerLocation;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class CreateLocationModal extends ModalComponent
{
    public $location;
    public $customer;
    protected array $rules = [
        'location.name' => 'nullable',
        'location.address' => 'required',
        'location.address_2' => 'nullable',
        'location.city' => 'required',
        'location.state' => 'required',
        'location.zip' => 'required',
        'location.phone' => 'nullable|phone:AUTO,US'
    ];

    public function mount($customerId): Void
    {
        $this->customer = Customer::findorFail($customerId);
        $this->location = new CustomerLocation;
    }

    public function create(): Void
    {
        $this->location->customer_id = $this->customer->id;
        $this->validate();
        $this->location->save();
        if (!$this->customer->default_address) {
            $this->customer->default_address = $this->location->id;
            $this->customer->save();
        }
        self::alert('success', 'Added Location');
        $this->emit('customerShowRefresh');
        $this->reset('location');
        $this->forceClose()->closeModal();

    }

    public function render(): View
    {
        return view('livewire.customer.modals.create-location-modal');
    }

    public static function bsModalTitle(): string
    {
        return 'Add Location';
    }
}