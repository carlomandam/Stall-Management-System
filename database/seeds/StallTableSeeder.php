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
            'stallID' => 1,
            'floorID' => 1,
            'stype_SizeID' => 1,
            'stallDesc'=> 'Stall 1',
            'stallStatus'=> 1,
            'stallPos'=> '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
        DB::table('tblStall')->insert([
            'stallID' => 2,
            'floorID' => 1,
            'stype_SizeID' => 1,
            'stallDesc'=> 'Stall 2',
            'stallStatus'=> 1,
            'stallPos'=> '6',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
        DB::table('tblStall')->insert([
            'stallID' => 3,
            'floorID' => 1,
            'stype_SizeID' => 1,
            'stallDesc'=> 'Stall 3',
            'stallStatus'=> 0,
            'stallPos'=> '6', 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
        DB::table('tblStall')->insert([
            'stallID' => 4,
            'floorID' => 1,
            'stype_SizeID' => 1,
            'stallDesc'=> 'Stall 4',
            'stallStatus'=> 1,
            'stallPos'=> '9', 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
        DB::table('tblStall')->insert([
            'stallID' => 5,
            'floorID' => 1,
            'stype_SizeID' => 1,
            'stallDesc'=> 'Stall 5',
            'stallStatus'=> 1,
            'stallPos'=> '10', 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
    }
}
