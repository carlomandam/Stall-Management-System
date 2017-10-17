<?php

use Illuminate\Database\Seeder;

class StallTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
           DB::table('tblStallType_Size')->insert([
            'stypeSizeID' => 1,
            'stypeArea' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
           DB::table('tblStallType_Size')->insert([
            'stypeSizeID' => 2,
            'stypeArea' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
