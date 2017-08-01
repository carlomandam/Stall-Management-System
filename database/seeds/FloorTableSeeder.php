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
            'floorDesc' => '1st Floor',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('tblFloor')->insert([
            'floorID' => 2,
            'bldgID' => 1,
            'floorCapacity' => 45,
            'floorDesc' => '2nd Floor',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('tblFloor')->insert([
            'floorID' => 3,
            'bldgID' => 1,
            'floorCapacity' => 40,
            'floorDesc' => '3rd Floor',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('tblFloor')->insert([
            'floorID' => 4,
            'bldgID' => 2,
            'floorCapacity' => 50,
            'floorDesc' => '1st Floor',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('tblFloor')->insert([
            'floorID' => 5,
            'bldgID' => 2,
            'floorCapacity' => 45,
            'floorDesc' => '2nd Floor',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('tblFloor')->insert([
            'floorID' => 6,
            'bldgID' => 3,
            'floorCapacity' => 50,
            'floorDesc' => 'Ground Floor',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('tblFloor')->insert([
            'floorID' => 7,
            'bldgID' => 4,
            'floorCapacity' => 30,
            'floorDesc' => '1st Floor',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('tblFloor')->insert([
            'floorID' => 8,
            'bldgID' => 4,
            'floorCapacity' => 50,
            'floorDesc' => '2nd Floor',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('tblFloor')->insert([
            'floorID' => 9,
            'bldgID' => 5,
            'floorCapacity' => 33,
            'floorDesc' => 'Ground Floor',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
