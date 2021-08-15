<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ShowRole extends Component
{
    public Role $role;
    public $permissions;

    public function render()
    {
        $this->permissions = Permission::all();
        return view('livewire.admin.roles.show-role');
    }
}
