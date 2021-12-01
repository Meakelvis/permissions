<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Elvis',
            'email' => 'markelvis37@gmail.com',
            'password' => Hash::make('mikelima'),
            'role_id' => Role::IS_ADMIN,
        ]);
    }
}
