<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class RemoveConnectedAccount extends ModalComponent
{
    public function render(): View
    {
        return view('livewire.profile.remove-connected-account');
    }

    public static function bsModalTitle(): string
    {
        return 'Remove Connected Account';
    }
}
