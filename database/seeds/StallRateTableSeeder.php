<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            'stallRateEffectivity' => Carbon::create('2017', '10', '18'),
            'dblRate' => 100.00,
            'stype_SizeID' => 1,
            'dblPeakAdditional' => 50.00,
            'peakRateType' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
