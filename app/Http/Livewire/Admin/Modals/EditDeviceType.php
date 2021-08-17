<?php

namespace App\Http\Livewire\Admin\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditDeviceType extends ModalComponent
{
    public function render()
    {
        return view('livewire.admin.modals.edit-device-type');
    }
}
