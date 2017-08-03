<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(BuildingTableSeeder::class);
        $this->call(FloorTableSeeder::class);
        $this->call(frequencyTableSeeder::class);
        $this->call(tblstalltypeSeeder::class);
        $this->call(StallSizeTableSeeder::class);
        $this->call(StallTypeStallSizeTableSeeder::class);
        $this->call(StallRateTableSeeder::class);
        $this->call(StallRateDetailsTableSeeder::class);
        




    }
}
