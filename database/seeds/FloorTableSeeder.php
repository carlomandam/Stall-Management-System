<?php

use Illuminate\Database\Seeder;

class FloorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tblFloor')->insert([
            'floorID' => 1,
            'bldgID' => 1,
            'floorCapacity' => 50,
            'floorLevel'=>1,
            'floorDesc' => '1st Floor',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('tblFloor')->insert([
            'floorID' => 2,
            'bldgID' => 1,
            'floorCapacity' => 50,
            'floorLevel'=>2,
            'floorDesc' => '2nd Floor',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('tblFloor')->insert([
            'floorID' => 3,
            'bldgID' => 2,
            'floorCapacity' => 50,
            'floorLevel'=>3,
            'floorDesc' => '1st Floor',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('tblFloor')->insert([
            'floorID' => 4,
            'bldgID' => 2,
            'floorCapacity' => 50,
            'floorLevel'=>4,
            'floorDesc' => '2nd Floor',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
    }
}
