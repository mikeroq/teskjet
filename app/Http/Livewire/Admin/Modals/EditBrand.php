<?php

namespace App\Http\Livewire\Admin\Modals;

use App\Models\Brand;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditBrand extends ModalComponent
{
    public string $name = '';
    public mixed $website = '';
    public mixed $support_number = '';

    public Brand $brand;

    public function mount($id): void
    {
        $this->brand = Brand::findOrFail($id);
        $this->name = $this->brand->name;
        $this->website = $this->brand->website;
        $this->support_number = $this->brand->support_number;

    }
    public function update(): void
    {
        $validated = $this->validate([
            'name' => 'required',
            'website' => 'nullable|url',
            'support_number' => 'nullable|phone:AUTO,US|unique:brands,support_number'
        ]);

        $this->brand->update($validated);
        $this->brand->save();

        $this->forceClose()->closeModal();

        $this->emit('refreshBrandTable');
        $this->alert('success', 'Updated', [
            'timer' =>  '2000'
        ]);

    }

    public static function bsModalTitle(): string
    {
        return 'Editing Brand';
    }

    public function render()
    {
        return view('livewire.admin.modals.edit-brand');
    }
}
