<?php

namespace App\Http\Livewire\Admin\Modals;

use App\Models\Permission;
use LivewireUI\Modal\ModalComponent;

class EditPermission extends ModalComponent
{
    public mixed $name = '';
    public mixed $description = '';

    public Permission $permission;

    public function mount($id): void
    {
        $this->permission = Permission::findOrFail($id);
        $this->name = $this->permission->name;
        $this->description = $this->permission->description;
    }

    public function update(): void
    {
        $validated = $this->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $this->permission->update($validated);
        $this->permission->save();

        $this->forceClose()->closeModal();

        $this->emit('refreshPermissionTable');
        self::alert('success', 'Updated', [
            'timer' =>  '2000'
        ]);
    }

    public static function bsModalTitle(): string
    {
        return 'Editing Permission';
    }

    public function render()
    {
        return view('livewire.admin.modals.edit-permission');
    }
}
