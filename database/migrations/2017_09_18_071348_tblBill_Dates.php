<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBillDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('tblBill_Dates', function (Blueprint $table) {
            $table->increments('billDatesID');
            $table->integer('billID')->unsigned();
            $table->date('billDate');
            $table->tinyInteger('isVoid');
       
            $table->timestamps();
            $table->softDeletes();
          

            $table->foreign('billID')
                 ->references('billID')
                 ->on('tblBilling')
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
        Schema::dropIfExists('tblBill_Dates');
    }
}
