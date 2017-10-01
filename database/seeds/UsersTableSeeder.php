<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  
        DB::table('users')->insert([
            'name' => 'Benito De Joya',
            'email' => 'dejoya@yahoo.com',
            'password' => bcrypt('admin123456'),
            'position'=> 'Admin',
            'username'=> 'admin',
        ]);

         DB::table('users')->insert([
            'name' => 'Brixter Kim Duenas',
            'email' => 'Brix@yahoo.com',
            'password' => bcrypt('admin123456'),
            'position'=> 'Employee',
            'username'=> 'employee',
        ]);
    }
}
