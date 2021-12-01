<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super User']);
        Role::create(['name' => 'Administator']);
        Role::create(['name' => 'General User']);
        Role::create(['name' => 'Organisation']);
        Role::create(['name' => 'Revert']);
        Role::create(['name' => 'Approval']);
    }
}
