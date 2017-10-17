<?php

use Illuminate\Database\Seeder;

class PivotSizeTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 1,
            'stypeID' => 1,
            'stypeSizeID' => 1,
          
        ]);
            DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 2,
            'stypeID' => 1,
            'stypeSizeID' => 2,
           
        ]);
    }
}
