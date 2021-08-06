<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class RemoveConnectedAccount extends ModalComponent
{
    public function render()
    {
        return view('livewire.profile.remove-connected-account');
    }

    public static function bsModalTitle(): string
    {
        return 'Remove Connected Account';
    }
}
