<?php

use Illuminate\Database\Seeder;

class StallTypeStallSizeTableSeeder extends Seeder
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
            'stype_SizedColor'=>'blue',
            
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 2,
            'stypeID' => 1,
            'stypeSizeID' => 2,
            'stype_SizedColor'=>'red',
           
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 3,
            'stypeID' => 2,
            'stypeSizeID' => 3,
            'stype_SizedColor'=>'Green',
            
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 4,
            'stypeID' => 2,
            'stypeSizeID' => 4,
            'stype_SizedColor'=>'Yellow',
            
        ]);

          DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 5,
            'stypeID' => 3,
            'stypeSizeID' => 1,
            'stype_SizedColor'=>'maroon',
            
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 6,
            'stypeID' => 3,
            'stypeSizeID' => 3,
            'stype_SizedColor'=>'indigo',
           
        ]);
   
      }
    
}
