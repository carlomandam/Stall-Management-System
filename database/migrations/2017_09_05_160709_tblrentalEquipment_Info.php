<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblrentalEquipmentInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblRentalEquip_Info', function (Blueprint $table) {
            $table->increments('rentalEquipInfoID');
            $table->integer('rentEquipmentID')->unsigned();
            $table->integer('equipmentID')->unsigned();
            $table->integer('equipmentQty');

       
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('rentEquipmentID')->references('rentEquipmentID')
                  ->on('tblRental_Equipment')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

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
       Schema::dropIfExists('tblRentalEquip_Info');
    }
}
