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
            $table->integer('stockStatus');
            $table->integer('stockQty');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('equipmentID')->references('equipmentID')
                  ->on('tblEquipment')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
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
