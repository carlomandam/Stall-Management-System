<?php

use Illuminate\Database\Seeder;


class tblUtilities_Initial extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('tblUtilities_Initial')->insert([
            'initialFeeDesc' => 'Security Deposit',
            'initialAmt' => '4000.00',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

         DB::table('tblUtilities_Initial')->insert([
            'initialFeeDesc' => 'Stall Maintenance Fee',
            'initialAmt' => '1000.00',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
         
    }
}
