<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPaymentBilling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('tblPayment_Billing', function (Blueprint $table) {
            $table->integer('paymentID')->unsigned();
            $table->integer('billID')->unsigned();
            
            $table->timestamps();
            $table->softDeletes();

             $table->foreign('paymentID')
                 ->references('paymentID')
                 ->on('tblPayment')
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
        Schema::dropIfExists('tblPayment_Billing');
    }
}
