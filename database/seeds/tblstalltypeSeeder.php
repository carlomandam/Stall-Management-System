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
            'stypeName' => 'Garments Type',
            'stypeDesc' => 'For Garments use',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
         DB::table('tblStallType')->insert([
            'stypeID' => 2,
            'stypeName' => 'Food Type',
            'stypeDesc' => ' ',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]); 
          DB::table('tblStallType')->insert([
            'stypeID' => 3,
            'stypeName' => 'Food  Type',
            'stypeDesc' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
           DB::table('tblStallType')->insert([
            'stypeID' => 4,
            'stypeName' => 'Bags Type',
            'stypeDesc' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
