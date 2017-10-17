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
        $this->call(UsersTableSeeder::class);
        $this->call(BuildingTableSeeder::class);
        $this->call(StallTypeTableSeeder::class);
        $this->call(TypeTableSeeder::class);
        $this->call(PivotSizeTypeTableSeeder::class);
        $this->call(StallRateTableSeeder::class);
        $this->call(FloorTableSeeder::class);
        $this->call(StallTableSeeder::class);
        $this->call(ChargesTableSeeder::class);
        $this->call(RequirementsTableSeeder::class);
        $this->call(HolidayTableSeeder::class);
        $this->call(StallUtilityTableSeeder::class);
        $this->call(UtilitiesTableSeeder::class);
        $this->call(InitialFeeTableSeeder::class);



        

    }
}
