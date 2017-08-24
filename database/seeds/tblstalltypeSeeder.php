<?php

use Illuminate\Database\Seeder;

class tblstalltypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('tblStallType')->insert([
            'stypeID' => 1,
            'stypeName' => 'Garments Stall',
            'stypeDesc' => 'Available for all Garments type Products',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
         DB::table('tblStallType')->insert([
            'stypeID' => 2,
            'stypeName' => 'Food Stall',
            'stypeDesc' => 'Available for all Food Products ',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]); 
          DB::table('tblStallType')->insert([
            'stypeID' => 3,
            'stypeName' => 'Accesories Stall',
            'stypeDesc' => 'Available for all Accesories type Products',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]); 

    }
}
