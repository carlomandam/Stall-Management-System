<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InitialFeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tblInitialFees')->insert([
    		'initID' => 1,
    		'initDesc' => 'Security Deposit',
    		'initAmt' => 4000.00,
    		'initEffectiveDate'=> Carbon::create('2017', '10', '18'),
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
    	]);

    	DB::table('tblInitialFees')->insert([
    		'initID' => 2,
    		'initDesc' => 'Maintenance Fee',
    		'initAmt' => 1000.00,
    		'initEffectiveDate'=> Carbon::create('2017', '10', '18'),
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
    	]);
    }
}
