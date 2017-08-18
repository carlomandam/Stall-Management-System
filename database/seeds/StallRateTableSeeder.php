<?php

use Illuminate\Database\Seeder;

class StallRateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('tblStallRate')->insert([
            'stallRateID' => 1,
            'frequencyDesc' => 1,
            'stype_SizeID' => 1,
            'stallRateEffectivity' => date('Y-m-d H:i:s'),
            
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
           DB::table('tblStallRate')->insert([
            'stallRateID' => 2,
            'frequencyDesc' => 2,
            'stallRateEffectivity' => date('Y-m-d H:i:s'),
            'stype_SizeID' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
             DB::table('tblStallRate')->insert([
            'stallRateID' => 3,
            'frequencyDesc' => 3,
            'stallRateEffectivity' => date('Y-m-d H:i:s'),
            'stype_SizeID' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);

    }
}
