<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tblPayment', function (Blueprint $table) {
            $table->increments('paymentID');
            $table->integer('transactionID')->unsigned();
            $table->date('paymentDate');
            $table->double('paidAmt',10,2);
            $table->timestamps();
            $table->softDeletes();
           
            $table->foreign('transactionID')->references('transactionID')
                ->on('TblPayment_Transaction')
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
         Schema::dropIfExists('tblPayment');
    }
}
