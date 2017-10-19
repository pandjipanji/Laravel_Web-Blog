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

        $user_admin =[
            "first_name" => "M",
            "last_name" => "Admin",
            "email" => "madmin@mail.com",
            "password" => "12345678"
        ];

        $adminuser = Sentinel::registerAndActivate($user_admin);
        $adminuser->roles()->attach($adminrole);

        //this is for seed data writer
        $role_writer = [
            "slug" => "writer",
            "name" => "Writer",
            "permissions" => [
                "articles.index" => true,
                "articles.create" => true,
                "articles.store" => true,
                "articles.show" => true,
                "articles.edit" => true,
                "articles.update" => true,
                "articles.delete_img" => true
            ]
        ];
        
        Sentinel::getRoleRepository()->createModel()->fill($role_writer)->save();
        $writerole = Sentinel::findRoleByName('Writer');

        $user_writer = [
            "first_name" => "Oda",
            "last_name" => "E",
            "email" => "oda@e.com",
            "password" => "12345678"
        ];

        $writeuser = Sentinel::registerAndActivate($user_writer);
        $writeuser->roles()->attach($writerole);
    }
}
