<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblStallRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblStallRate', function (Blueprint $table) {
            $table->increments('stallRateID');
            $table->integer('frequencyDesc');
            $table->date('stallRateEffectivity');
            $table->integer('stype_SizeID')->unsigned();
            $table->timestamps();
            $table->softDeletes();
             
       
            $table->foreign('stype_SizeID')->references('stype_SizeID')->on('tblstallType_stallSize');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblStallRate');
    }
}
