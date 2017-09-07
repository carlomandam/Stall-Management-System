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
            $table->date('stallRateEffectivity');
            $table->integer('stype_SizeID')->unsigned();
            $table->double('dblRate',10,2); //standard rate 100 pesos per day talaga kunwari
            $table->double('dblPeakRate',10,2);
            $table->integer('peakRateType')->unsigned();
            $table->timestamps();
            $table->softDeletes();
             
       
            $table->foreign('stype_SizeID')->references('stype_SizeID')
                  ->on('tblstallType_stallSize')
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
        Schema::dropIfExists('tblStallRate');
    }
}
