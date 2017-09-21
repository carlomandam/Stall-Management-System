<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPaymentCharge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tblPayment_Charge', function (Blueprint $table) {
            $table->integer('paymentID')->unsigned();
            $table->integer('chargeDetID')->unsigned();

            $table->timestamps();
            $table->softDeletes();

             $table->foreign('paymentID')
                 ->references('paymentID')
                 ->on('tblPayment')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');
             $table->foreign('chargeDetID')
                 ->references('chargeDetID')
                 ->on('tblCharge_Details')
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
         Schema::dropIfExists('tblPayment_Charge');
    }
}
