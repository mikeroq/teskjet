<?php

namespace App\Http\Livewire\Admin\Modals;

use App\Models\Role;
use LivewireUI\Modal\ModalComponent;

class EditRole extends ModalComponent
{
    public mixed $name = '';
    public mixed $description = '';

    public Role $role;

    public function mount($id): void
    {
        $this->role = Role::findOrFail($id);
        $this->name = $this->role->name;
        $this->description = $this->role->description;
    }

    public function update(): void
    {
        $validated = $this->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $this->role->update($validated);
        $this->role->save();

        $this->forceClose()->closeModal();

        $this->emit('refreshRoleTable');
        self::alert('success', 'Updated', [
            'timer' =>  '2000'
        ]);
    }

    public static function bsModalTitle(): string
    {
        return 'Editing Role';
    }

    public function render()
    {
        return view('livewire.admin.modals.edit-role');
    }
}
