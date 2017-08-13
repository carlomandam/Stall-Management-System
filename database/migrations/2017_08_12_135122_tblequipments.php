<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tblequipments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblEquipment', function (Blueprint $table) {
            $table->increments('equipmentID');
            $table->string('equipmentName',200);
            $table->integer('rental_or_not_or_both');
            $table->double('rental_daily_rate');
            $table->integer('equipmentLimit_per_stall');
            $table->softDeletes();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('tblEquipment');
    }
}
