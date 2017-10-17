<?php

use Illuminate\Database\Seeder;

class HolidayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
             DB::table('tblHoliday')->insert([
            'ID' => 1,
            'Name' => 'Christmas',
            'Month' => 12,
            'Day'=> 24,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
