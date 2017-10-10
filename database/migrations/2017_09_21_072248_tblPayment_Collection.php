<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPaymentCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tblPayment_Collection', function (Blueprint $table) {
            $table->increments('paymentCollectID');
            $table->integer('transactionID')->unsigned();
            $table->integer('collectionDetID')->unsigned();
            $table->double('partialAmt',10,2);
            $table->tinyInteger('isVoidOrRefund');
            //1- full 
            //2- partial
            //3- advance
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('transactionID')->references('transactionID')
                ->on('TblPayment_Transaction')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('collectionDetID')
                ->references('collectionDetID')
                ->on('tblCollection_Details')
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
         Schema::dropIfExists('tblPayment_Collection');
    }
}
