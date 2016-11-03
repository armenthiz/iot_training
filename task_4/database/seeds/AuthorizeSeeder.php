<?php

use Illuminate\Database\Seeder;

class AuthorizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // This for seed data admin
        $role_admin = [
            'slug' => 'admin',
            'name' => 'Admin',
            'permissions' => [
                'admin' => true
            ]
        ];

        Sentinel::getRoleRepository()->createModel()->fill($role_admin)->save();
        $adminrole = Sentinel::findRoleByName('Admin');
        $user_admin = [
            'first_name' => 'M',
            'last_name' => 'Admin',
            'email' => 'madmin@mail.com',
            'password' => '12345678'
        ];
        $adminuser = Sentinel::registerAndActivate($user_admin);
        $adminuser->roles()->attach($adminrole);

        // this for seed data writer
        $role_writer = [
            'slug' => 'writer',
            'name' => 'Writer',
            'permissions' => [
                'articles.index' => true,
                'articles.create' => true,
                'articles.store' => true,
                'articles.show' => true,
                'articles.edit' => true,
                'articles.update' => true,
            ]
        ];

        Sentinel::getRoleRepository()->createModel()->fill($role_writer)->save();
        $writerrole = Sentinel::findRoleByName('Writer');
        $user_writer = [
            'first_name' => 'Oda',
            'last_name' => 'E',
            'email' => 'oda@e.com',
            'password' => '123456789'
        ];      

        $writeruser = Sentinel::registerAndActivate($user_writer);
        $writeruser->roles()->attach($writerrole);
    }
}
