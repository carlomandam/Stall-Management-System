<?php

use Illuminate\Database\Seeder;

class tblCollection_Status extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
           DB::table('tblCollection_Status')->insert([
            'collectionStatusName' => 'Collect',
            'collectionDebtAmt' => '1000.00',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

         DB::table('tblCollection_Status')->insert([
            'collectionStatusName' => 'Reminder',
            'collectionDebtAmt' => '2000.00',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

          DB::table('tblCollection_Status')->insert([
            'collectionStatusName' => 'Warning',
            'collectionDebtAmt' => '3000.00',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

         DB::table('tblCollection_Status')->insert([
            'collectionStatusName' => 'Lock',
            'collectionDebtAmt' => '4000.00',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


           DB::table('tblCollection_Status')->insert([
            'collectionStatusName' => 'Terminate',
            'collectionDebtAmt' => '5000.00',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
