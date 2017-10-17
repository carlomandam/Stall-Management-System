<?php

use Illuminate\Database\Seeder;

class UtilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tblUtilities')->insert([
    		'utilitiesID' => 'util_collection_status',
    		'collect' => 1000.00,
    		'reminder' => 2000.00,
    		'warning' => 3000.00,
    		'lock' => 4000.00,
    		'terminate' => 5000.00,
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
    	]);

    	DB::table('tblUtilities')->insert([
    		'utilitiesID' => 'util_market_days',
    		'utilitiesDesc' => 'sun,mon,tue,wed,thur,fri,sat',
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
    	]);

    	DB::table('tblUtilities')->insert([
    		'utilitiesID' => 'util_peak_days',
    		'utilitiesDesc' => 'mon,fri,sat',
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
    	]);


    }
}
