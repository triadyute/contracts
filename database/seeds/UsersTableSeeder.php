<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::find(1);
        $role_editor  = Role::find(2);
        $role_admin  = Role::find(3);
        $role_superuser  = Role::find(4);

        $user = factory(User::class)->create(['email' => 'user@contractmanager.com',
        'company_id' => 1]);
        $user->roles()->attach($role_user);
        $user->save();

        $editor = factory(User::class)->create(['email' => 'editor@contractmanager.com',
        'company_id' => 1]);
        $editor->roles()->attach($role_editor);
        $editor->save();

        $admin = factory(User::class)->create(['email' => 'admin@contractmanager.com',
        'company_id' => 1]);
        $admin->roles()->attach($role_admin);
        $admin->save();

        $superuser = factory(User::class)->create(['email' => 'superuser@contractmanager.com']);
        $superuser->roles()->attach($role_superuser);
        $superuser->save();
    }
}
