<?php

namespace App\Http\Livewire\Admin\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CreateBrand extends ModalComponent
{
    public function render()
    {
        return view('livewire.admin.modals.create-brand');
    }
}
