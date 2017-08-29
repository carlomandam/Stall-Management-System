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
            $table->double('rentDailyRate');
            $table->integer('equipStallLimit');
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
