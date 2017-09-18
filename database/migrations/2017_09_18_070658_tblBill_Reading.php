<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBillReading extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('tblBill_Reading', function (Blueprint $table) {
            $table->increments('billReadingID');
            $table->integer('readingID')->unsigned();
            $table->integer('billID')->unsigned();
       
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('readingID')
                 ->references('readingID')
                 ->on('tblMonthlyReading')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');

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
           Schema::dropIfExists('tblBill_Reading');
    }
}
