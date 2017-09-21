<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblmonthlyReading extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblMonthlyReading', function (Blueprint $table) {
            $table->increments('readingID');
            $table->integer('stallUtilityID')->unsigned()->index();
            $table->integer('previousReading');
            $table->integer('currentReading');
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
        Schema::dropIfExists('tblMonthlyReading');
    }
}
