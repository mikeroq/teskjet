<?php

namespace App\Http\Livewire\Customer\Modals;

use App\Models\CustomerLocation;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class EditLocationModal extends ModalComponent
{
    public CustomerLocation $location;
    protected array $rules = [
        'location.name' => 'nullable',
        'location.address' => 'required',
        'location.address_2' => 'nullable',
        'location.city' => 'required',
        'location.state' => 'required',
        'location.zip' => 'required',
        'location.phone' => 'nullable|phone:AUTO,US',
    ];

    public static function bsModalTitle(): string
    {
        return 'Update Location';
    }

    public function mount(int $locationId): void
    {
        $this->location = CustomerLocation::findOrFail($locationId);
    }

    public function update(): void
    {
        $this->validate();
        $this->location->save();
        if ($this->location->wasChanged()) {
            self::alert('success', 'Location updated!');
            $this->emit('customerShowRefresh');
            $this->forceClose()->closeModal();
        } else {
            self::alertPreset('toast', 'info', 'You did not modify any fields!');
        }
    }

    public function render(): View
    {
        return view('livewire.customer.modals.edit-location-modal');
    }
}
