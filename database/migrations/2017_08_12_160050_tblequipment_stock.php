<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblequipmentStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblEquipment_Stock', function (Blueprint $table) {
            $table->increments('equipmentStockID');
            $table->integer('equipmentID')->unsigned()->index();
            $table->integer('stockStatusID')->unsigned();
            $table->integer('stockQty');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('equipmentID')->references('equipmentID')->on('tblEquipment')
              ->onDelete('cascade');
            $table->foreign('stockStatusID')->references('stockStatusID')->on('tblStockStatus')
              ->onDelete('cascade');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblEquipment_Stock');
    }
}
