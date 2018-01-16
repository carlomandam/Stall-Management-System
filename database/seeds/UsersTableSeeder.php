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
            'fname' => 'Benito',
            'mname' => '',
            'lname' => 'De Joya',
            'email' => 'dejoya@yahoo.com',
            'password' => bcrypt('1234'),
            'position'=> 'Admin',
        ]);

         DB::table('users')->insert([
            'fname' => 'Brixter Kim',
            'mname' => 'Abnormal',
            'lname' => 'Duenas',
            'email' => 'Brix@yahoo.com',
            'password' => bcrypt('admin'),
            'position'=> 'Staff',
        ]);
    }
}
