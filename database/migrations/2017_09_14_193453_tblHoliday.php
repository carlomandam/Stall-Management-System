<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblHoliday extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblHoliday', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('Name',200);
            $table->integer('Month')->unsigned();
            $table->integer('Day')->unsigned();
            $table->text('Desc')->nullable();
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
        Schema::dropIfExists('tblBill_MonthlyReading');
    }
}
