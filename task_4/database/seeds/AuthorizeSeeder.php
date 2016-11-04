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

        Sentinel::getRoleRepository()
                ->createModel()
                ->fill($role_admin)
                ->save();

        // this for seed data writer
        $role_writer = [
            'slug' => 'writer',
            'name' => 'Writer',
            'permissions' => [
                'articles.index' => true,
                'articles.store' => true,
                'articles.create' => true,
                'articles.destroy' => true,
                'articles.show' => true,
                'articles.update' => true,
                'articles.edit' => true,
                'comments.index' => true,
                'comments.store' => true,
                'comments.create' => true,
                'comments.destroy' => true,
                'comments.show' => true,
                'comments.update' => true,
                'comments.edit' => true,
                'articles.storeExcel' => true,
                'articles.showExportPdf' => true,
                'articles.showExportExcel' => true,
            ]
        ];

        Sentinel::getRoleRepository()
                ->createModel()
                ->fill($role_writer)
                ->save();
    }
}
