<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
            'description' => 'Default role for admin users.',
        ]);
        Role::create([
            'name' => 'User',
            'guard_name' => 'web',
            'description' => 'Default role for all users.',
        ]);
    }
}
