<?php

namespace App\Http\Livewire\Admin\Role;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ShowRole extends Component
{
    public Role $role;
    public Collection|Permission $permissions;

    public function render()
    {
        $this->permissions = Permission::all();

        return view('livewire.admin.roles.show-role');
    }
}
