<?php

namespace App\Http\Livewire\Admin\Modals;

use App\Models\Permission;
use App\Models\Role;
use LivewireUI\Modal\ModalComponent;

class CreateRole extends ModalComponent
{
    public string $name = '';
    public string $description = '';
    public string $guard_name = 'web';

    public static function bsModalTitle(): string
    {
        return 'Add Role';
    }

    public function create(): void
    {
        $validated = $this->validate([
            'name' => 'required',
            'description' => 'nullable',
            'guard_name' => 'required',
        ]);

        Role::create($validated);

        $this->reset();
        $this->forceClose()->closeModalWithEvents(['refreshRoleTable']);
        self::alert('success', 'Added Role ', [
            'timer' =>  '2000',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.modals.create-role');
    }
}
