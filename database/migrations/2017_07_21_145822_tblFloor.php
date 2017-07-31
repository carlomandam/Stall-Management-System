<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblFloor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblFloor', function (Blueprint $table) {
            $table->increments('floorID');
            $table->integer('bldgID')->unsigned();
            $table->string('floorDesc',200)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('bldgID')->references('bldgID')->on('tblBuilding');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblFloor');
    }
}
