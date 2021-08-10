<?php

namespace App\Http\Livewire\Customer\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CreateLocationModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.customer.modals.create-location-modal');
    }

    public static function bsModalTitle(): string
    {
        return 'Add Location';
    }
}
