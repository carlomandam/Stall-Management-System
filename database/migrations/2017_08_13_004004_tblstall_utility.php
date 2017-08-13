<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblstallUtility extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblStall_Utilities', function (Blueprint $table) {
            $table->increments('stallUtilityID');
            $table->string('stallID')->index();
            $table->integer('utilitiesID')->unsigned();
            $table->integer('rateType');
            $table->string('meterID',20);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stallID')->references('stallID')->on('tblStall')
              ->onDelete('cascade');
            $table->foreign('utilitiesID')->references('utilitiesID')->on('tblUtilities')
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
        Schema::dropIfExists('tblStall_Utilities');
    }
}
