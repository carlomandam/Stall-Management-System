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
            $table->integer('prevReading');
            $table->integer('presReading');
            $table->datetime('readingFrom');
            $table->datetime('readingTo');
            $table->double('totalBillAmount',8,2);
            $table->double('multiplier',8,2);
            $table->integer('utilType');
            $table->integer('isFinalize')->nullable();
          
            $table->timestamps();
            $table->softDeletes();

        
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
