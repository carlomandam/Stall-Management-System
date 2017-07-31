<?php

use Illuminate\Database\Seeder;

class frequencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // check if table users is empty
        if(DB::table('tblFrequency')->get()->count() == 0){

            DB::table('tblFrequency')->insert([

                [
                    'frequencyDesc' => 'Daily',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [   'frequencyDesc' => 'Weekly',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'frequencyDesc' => 'Monthly',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],   
                [
                    'frequencyDesc' => 'Yearly',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]


            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
