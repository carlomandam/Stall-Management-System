<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblStallUtilitiesMeterID extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblStallUtilities_MeterID', function (Blueprint $table) {
            $table->integer('stallUtilityID')->unsigned()->index();
            $table->string('meterID');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stallUtilityID')->references('stallUtilityID')->on('tblStall_Utilities')
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
        Schema::dropIfExists('tblStallUtilities_MeterID');
    }
}
