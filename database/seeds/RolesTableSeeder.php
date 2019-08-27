<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'User',
            'description' => 'Can view contract alerts'
        ]);
        Role::create([
            'name' => 'Editor',
            'description' => 'Can view and edit contract alerts'
        ]);
        Role::create([
            'name' => 'Admin',
            'description' => 'Manages all contracts and users for a company'
        ]);
        Role::create([
            'name' => 'SuperUser',
            'description' => 'All privileges'
        ]);
    }
}
