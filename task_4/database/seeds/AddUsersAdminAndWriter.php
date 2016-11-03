<?php

use Illuminate\Database\Seeder;

class AddUsersAdminAndWriter extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' =>  'aldy.me@gmail.com',
            'password' => bcrypt('aldy'),
            'roles' => ['writer'],
            'first_name' => 'Aldy',
            'last_name' => 'S',
            'permissions' => [
                "articles.index" => true,
                "articles.create" => true,
                "articles.store" => true,
                "articles.show" => true,
                "articles.edit" => true,
                "articles.update" => true
            ],
        ]);
    }
}
