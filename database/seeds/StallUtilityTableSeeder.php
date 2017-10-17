<?php

use Illuminate\Database\Seeder;

class StallUtilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	DB::table('tblStall_Utilities')->insert([
    		'stallUtilityID' => 1,
    		'stallID' => 'MYSE-101',
    		'utilityType' => 1,
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
    	]);

    	DB::table('tblStall_Utilities')->insert([
    		'stallUtilityID' => 2,
    		'stallID' => 'MYSE-102',
    		'utilityType' => 1,
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
    	]);

    	DB::table('tblStall_Utilities')->insert([
    		'stallUtilityID' => 3,
    		'stallID' => 'MYSE-103',
    		'utilityType' => 1,
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
    	]);

    	DB::table('tblStall_Utilities')->insert([
    		'stallUtilityID' => 4,
    		'stallID' => 'MYSE-104',
    		'utilityType' => 2,
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
    	]);
    	DB::table('tblStall_Utilities')->insert([
    		'stallUtilityID' => 5,
    		'stallID' => 'MYSE-101',
    		'utilityType' => 2,
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
    	]);
    }
}
