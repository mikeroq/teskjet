<?php

namespace App\Http\Livewire\Admin\Modals;

use App\Models\DeviceType;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditDeviceType extends ModalComponent
{
    public string $name;

    public DeviceType $deviceType;

    public function mount($id): void
    {
        $this->deviceType = DeviceType::findOrFail($id);
        $this->name = $this->deviceType->name;

    }

    public function update(): void
    {
        $validated = $this->validate([
            'name' => 'required'
        ]);

        $this->deviceType->update($validated);
        $this->deviceType->save();

        $this->forceClose()->closeModal();

        $this->emit('refreshDeviceTypeTable');
        self::alert('success', 'Updated', [
            'timer' =>  '2000'
        ]);

    }

    public static function bsModalTitle(): string
    {
        return 'Editing Device Type';
    }

    public function render()
    {
        return view('livewire.admin.modals.edit-device-type');
    }
}
