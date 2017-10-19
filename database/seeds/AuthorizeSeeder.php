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
        //this is for seed data admin
        $role_admin = [
            "slug" =>"admin",
            "name" => "admin",
            "permissions" => [
                "admin" => true
            ]
        ];

        Sentinel::getRoleRepository()->createModel()->fill($role_admin)->save();
        $adminrole = Sentinel::findRoleByName('admin');

        $
    }
}
