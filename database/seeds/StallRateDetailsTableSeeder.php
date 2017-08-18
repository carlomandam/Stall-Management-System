<?php

use Illuminate\Database\Seeder;

class StallRateDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tblStallRate_Details')->insert([
            'stallRateID' => 1,
            'stallRateDesc' => 1,
            'dblRate' => 200.00,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
        DB::table('tblStallRate_Details')->insert([
            'stallRateID' => 1,
            'stallRateDesc' => 2,
            'dblRate' => 150.00,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
         DB::table('tblStallRate_Details')->insert([
            'stallRateID' => 1,
            'stallRateDesc' => 3,
            'dblRate' => 200.00,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
        DB::table('tblStallRate_Details')->insert([
            'stallRateID' => 1,
            'stallRateDesc' => 4,
            'dblRate' => 150.00,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
         DB::table('tblStallRate_Details')->insert([
            'stallRateID' => 1,
            'stallRateDesc' => 5,
            'dblRate' => 200.00,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
        DB::table('tblStallRate_Details')->insert([
            'stallRateID' => 1,
            'stallRateDesc' => 6,
            'dblRate' => 150.00,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
          DB::table('tblStallRate_Details')->insert([
            'stallRateID' => 1,
            'stallRateDesc' => 7,
            'dblRate' => 150.00,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
            DB::table('tblStallRate_Details')->insert([
            'stallRateID' => 2,
            'stallRateDesc' => 1,
            'dblRate' => 3000.00,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
            DB::table('tblStallRate_Details')->insert([
            'stallRateID' => 3,
            'stallRateDesc' => 1,
            'dblRate' => 10000.00,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);

    }
}
