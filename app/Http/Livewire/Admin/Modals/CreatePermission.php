<?php

namespace App\Http\Livewire\Admin\Modals;

use App\Models\Permission;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CreatePermission extends ModalComponent
{
    public string $name = '';
    public string $description = '';
    public string $guard_name = 'web';

    public static function bsModalTitle(): string
    {
        return 'Add Permission';
    }

    public function create(): void
    {
        $validated = $this->validate([
            'name' => 'required',
            'description' => 'nullable',
            'guard_name' => 'required'
        ]);

        Permission::create($validated);

        $this->reset();
        $this->forceClose()->closeModalWithEvents(['refreshPermissionTable']);
        $this->alert('success', 'Added Role ', [
            'timer' =>  '2000'
        ]);
    }
    public function render()
    {
        return view('livewire.admin.modals.create-permission');
    }
}
