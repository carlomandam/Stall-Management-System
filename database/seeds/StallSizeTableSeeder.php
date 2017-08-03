<?php

use Illuminate\Database\Seeder;

class StallSizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('tblStallType_Size')->insert([
            'stypeSizeID' => 1,
            'stypeArea' => 200,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
         DB::table('tblStallType_Size')->insert([
            'stypeSizeID' => 2,
            'stypeArea' => 300,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
         DB::table('tblStallType_Size')->insert([
            'stypeSizeID' => 3,
            'stypeArea' => 150,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
         DB::table('tblStallType_Size')->insert([
            'stypeSizeID' => 4,
            'stypeArea' => 140,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
