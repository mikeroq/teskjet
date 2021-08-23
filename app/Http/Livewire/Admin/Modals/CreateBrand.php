<?php

namespace App\Http\Livewire\Admin\Modals;

use App\Models\Brand;
use LivewireUI\Modal\ModalComponent;

class CreateBrand extends ModalComponent
{
    public string $name = '';
    public string $website = '';
    public string $support_number = '';

    public function render()
    {
        return view('livewire.admin.modals.create-brand');
    }

    public static function bsModalTitle(): string
    {
        return 'Add Brand';
    }

    public function create(): void
    {
        $validated = $this->validate([
            'name' => 'required',
            'website' => 'nullable|url',
            'support_number' => 'nullable|phone:AUTO,US|unique:brands,support_number'
        ]);

        Brand::create($validated);

        $this->reset();
        $this->forceClose()->closeModalWithEvents(['refreshDeviceTypeTable']);
        self::alert('success', 'Added Device Type', [
            'timer' =>  '2000'
        ]);
    }
}
