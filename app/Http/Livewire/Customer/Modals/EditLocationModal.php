<?php

namespace App\Http\Livewire\Customer\Modals;

use App\Models\CustomerLocation;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditLocationModal extends ModalComponent
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

    public CustomerLocation $location;

    public static function bsModalTitle(): string
    {
        return 'Editing Location';
    }

    public function mount(int $locationId): void
    {
        $this->location = CustomerLocation::findOrFail($locationId);
        $this->fill([
            'name' => $this->location->name,
            'address' => $this->location->address,
            'address_2' => $this->location->address_2,
            'city' => $this->location->city,
            'state' => $this->location->state,
            'zip' => $this->location->zip,
            'phone' => $this->location->phone
        ]);
    }

    public function update(): void
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

        $this->location->update($validated);
        $this->location->save();

        if ($this->location->wasChanged()) {
            self::alert('success', 'Edit Successful', [
                'position' =>  'center',
                'timer' =>  '2000',
                'toast' =>  false,
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
            $this->emit('customerShowRefresh');
            $this->forceClose()->closeModal();
        } else {
            self::alert('info', 'Notice', [
                'position' =>  'top-end',
                'text' => 'You did not modify any fields. Nothing was changed.',
                'toast' =>  true,
                'timer' => '3000',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
        }
    }

    public function render(): View
    {
        return view('livewire.customer.modals.edit-location-modal');
    }

}
