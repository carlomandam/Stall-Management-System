<?php

use Illuminate\Database\Seeder;

class StallTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
            DB::table('tblStall')->insert([
            'stallID' => 'MYSE-101',
            'floorID' => 1,
            'stype_SizeID' => 1,
            'stallStatus' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


            DB::table('tblStall')->insert([
            'stallID' => 'MYSE-102',
            'floorID' => 1,
            'stype_SizeID' => 1,
            'stallStatus' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

            DB::table('tblStall')->insert([
            'stallID' => 'MYSE-103',
            'floorID' => 1,
            'stype_SizeID' => 1,
            'stallStatus' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

            DB::table('tblStall')->insert([
            'stallID' => 'MYSE-104',
            'floorID' => 1,
            'stype_SizeID' => 1,
            'stallStatus' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

            DB::table('tblStall')->insert([
            'stallID' => 'MYSE-105',
            'floorID' => 1,
            'stype_SizeID' => 1,
            'stallStatus' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
