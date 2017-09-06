<?php

use Illuminate\Database\Seeder;


class tblUtilities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
         DB::table('tblUtilities')->insert([
            'utilitiesID'=> 1,
            'utilitiesDesc' => '()',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
         
    }
}
