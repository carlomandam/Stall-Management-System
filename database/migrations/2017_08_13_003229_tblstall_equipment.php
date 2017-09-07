<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblstallEquipment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tblStall_Equipment', function (Blueprint $table) {
            $table->increments('stallEquipmentID');
            $table->string('stallID')->index();
            $table->integer('equipmentID')->unsigned();
            $table->integer('equipmentQty');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stallID')->references('stallID')
                  ->on('tblStall')
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
        Schema::dropIfExists('tblStall_Equipment');
    }
}
