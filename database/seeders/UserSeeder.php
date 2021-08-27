<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mike Roquemore',
            'email' => 'mikeroq@gmail.com',
            'password' => Hash::make('password'),
            'user_level' => 9,
        ]);
    }
}
