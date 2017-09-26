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
            $table->integer('previousReading');
            $table->integer('currentReading');
            $table->datetime('readingFrom');
            $table->datetime('readingTo');
            $table->double('totalAmount',8,2);
          
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
