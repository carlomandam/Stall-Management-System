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
            $table->increments('stallMeterID');
            $table->integer('contractID')->unsigned()->index();
            $table->integer('readingID')->unsigned()->index();
            $table->double('utilityAmt',10,2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('contractID')->references('contractID')
                  ->on('tblContractInfo')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

             $table->foreign('readingID')->references('readingID')
                  ->on('tblMonthlyReading')
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
        Schema::dropIfExists('tblStallUtilities_MeterID');
    }
}
