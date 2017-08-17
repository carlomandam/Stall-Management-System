<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          if(DB::table('tblProduct')->get()->count() == 0){

            DB::table('tblProduct')->insert([

                [
                    'productName' => 'Toys'
                ],
                [   
                	'productName' => 'Clothes'
                ],
                [
                    'productName' => 'Slippers'
                ],   
                [
                    'productName' => 'Garments'
                ]


            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
