<?php

use Illuminate\Database\Seeder;

class BuildingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('tblBuilding')->insert([
            'bldgID' => 1,
            'bldgName' => 'My Seoul',
            'bldgCode' => 'myse1',
            'bldgDesc' => 'Goods and Garments',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
         DB::table('tblBuilding')->insert([
            'bldgID' => 2,
            'bldgName' => 'Bagpi Taytay',
            'bldgCode' => 'bagpi2',
            'bldgDesc' => 'Goods and Garments',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
         DB::table('tblBuilding')->insert([
            'bldgID' => 3,
            'bldgName' => 'Taytay Stalls Center',
            'bldgCode' => 'tayt3',
            'bldgDesc' => 'Garments only',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
         DB::table('tblBuilding')->insert([
            'bldgID' => 4,
            'bldgName' => 'Stall Center',
            'bldgCode' => 'Stal4',
            'bldgDesc' => 'Garments only',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
}