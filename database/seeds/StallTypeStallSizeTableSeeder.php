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
            'stypeID' => 1,
            'stypeSizeID' => 3,
            'stype_SizedColor'=>'Green',
            
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 4,
            'stypeID' => 1,
            'stypeSizeID' => 4,
            'stype_SizedColor'=>'Yellow',
            
        ]);

          DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 5,
            'stypeID' => 2,
            'stypeSizeID' => 1,
            'stype_SizedColor'=>'maroon',
            
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 6,
            'stypeID' => 2,
            'stypeSizeID' => 2,
            'stype_SizedColor'=>'indigo',
           
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 7,
            'stypeID' => 2,
            'stypeSizeID' => 3,
            'stype_SizedColor'=>'pink',
            
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 9,
            'stypeID' => 2,
            'stypeSizeID' => 4,
            'stype_SizedColor'=>'white',
            
        ]);

          DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 10,
            'stypeID' => 3,
            'stypeSizeID' => 1,
            'stype_SizedColor'=>'orange',
            
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 11,
            'stypeID' => 3,
            'stypeSizeID' => 2,
            'stype_SizedColor'=>'gray',
           
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 12,
            'stypeID' => 3,
            'stypeSizeID' => 3,
            'stype_SizedColor'=>'black',
            
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 13,
            'stypeID' => 3,
            'stypeSizeID' => 4,
            'stype_SizedColor'=>'blue-green',
           
        ]);
          DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 14,
            'stypeID' => 4,
            'stypeSizeID' => 1,
            'stype_SizedColor'=>'blue-gray',
           
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 15,
            'stypeID' => 4,
            'stypeSizeID' => 2,
            'stype_SizedColor'=>'red',
           
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 16,
            'stypeID' => 4,
            'stypeSizeID' => 3,
            'stype_SizedColor'=>'white',
           
        ]);
         DB::table('tblstallType_stallSize')->insert([
            'stype_SizeID' => 17,
            'stypeID' => 4,
            'stypeSizeID' => 4,
            'stype_SizedColor'=>'orange',
            
        ]);
        
    }
}
