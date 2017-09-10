<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBillMonthlyReading extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tblBill_MonthlyReading', function (Blueprint $table) {
            $table->integer('billID')->unsigned()->index();
            $table->integer('readingID')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('billID')->references('billID')
                  ->on('tblBilling_Info')
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
        Schema::dropIfExists('tblBill_MonthlyReading');
    }
}
