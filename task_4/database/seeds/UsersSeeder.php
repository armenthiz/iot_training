<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Sentinel::findRoleByName('Writer');
        $user = [
            'first_name' => 'new',
            'last_name' => 'writser',
            'email' => strtolower(str_random(4) . '@gmail.com'),
            'password' => '123123123',
            'permissions' => json_decode($role['original']['permissions'], true)
        ];

        $user = Sentinel::registerAndActivate($user);
    }
}
