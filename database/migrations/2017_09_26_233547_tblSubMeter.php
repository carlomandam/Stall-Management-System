<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblSubMeter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tblSubMeter', function (Blueprint $table) {
            $table->increments('subMeterID');
            $table->integer('stallUtilityID')->unsigned()->index();
            $table->integer('prevRead');
            $table->integer('presRead');
             $table->datetime('readingFrom');
            $table->datetime('readingTo');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stallUtilityID')->references('stallUtilityID')
                  ->on('tblStall_Utilities')
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
        //
        Schema::dropIfExists('tblSubMeter');
    }
}
