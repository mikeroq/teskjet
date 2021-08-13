<?php

namespace App\Http\Livewire\Customer\Modals;

use App\Models\Customer;
use App\Models\CustomerLocation;
use LivewireUI\Modal\ModalComponent;

class CreateLocationModal extends ModalComponent
{
    public string $name = '';
    public string $address = '';
    public string $address_2 = '';
    public string $city = '';
    public string $state = '';
    public string $zip = '';
    public string $phone = '';
    public array $state_list = [
        'AL', 'AK', 'AS', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC', 'FM',
        'FL', 'GA', 'GU', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA',
        'ME', 'MH', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV',
        'NH', 'NJ', 'NM', 'NY', 'NC', 'ND', 'MP', 'OH', 'OK', 'OR', 'PW',
        'PA', 'PR', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VT', 'VI', 'VA',
        'WA', 'WV', 'WI', 'WY', 'AE', 'AA', 'AP'
    ];
    public Customer $customer;

    public function mount($customerId)
    {
        $this->customer = Customer::findorFail($customerId);
    }

    public function create()
    {
        $validated = $this->validate([
            'name' => 'nullable',
            'address' => 'required',
            'address_2' => 'nullable',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone' => 'nullable|phone:AUTO,US'
        ],
        [
            'phone.phone' => 'Must be a valid North American phone number.',
        ]);
        $validated['customer_id'] = $this->customer->id;
        $location = CustomerLocation::create($validated);


        if (!$this->customer->default_address) {
            $this->customer->default_address = $location->id;
            $this->customer->save();
        }
        $this->flash('success', 'Successful', [
            'position' =>  'center',
            'timer' =>  '1500',
            'toast' =>  false,
            'text' =>  'Added Location',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);

        $this->emit('customerShowRefresh');
        $this->forceClose()->closeModal();
        $this->reset([
            'name',
            'address',
            'address_2',
            'city',
            'state',
            'zip',
            'phone'
        ]);

    }

    public function render()
    {
        return view('livewire.customer.modals.create-location-modal');
    }

    public static function bsModalTitle(): string
    {
        return 'Add Location';
    }
}
