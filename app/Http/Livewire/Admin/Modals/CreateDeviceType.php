<?php

namespace App\Http\Livewire\Admin\Modals;

use App\Models\DeviceType;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class CreateDeviceType extends ModalComponent
{
    public string $name = '';

    public function render(): View
    {
        return view('livewire.admin.modals.create-device-type');
    }

    public static function bsModalTitle(): string
    {
        return 'Add Device Type';
    }

    public function create(): void
    {
        $validated = $this->validate([
            'name' => 'required'
        ]);

        DeviceType::create($validated);

        $this->reset();
        $this->forceClose()->closeModalWithEvents(['refreshDeviceTypeTable']);
        $this->alert('success', 'Added Device Type', [
            'timer' =>  '2000'
        ]);
    }
}
