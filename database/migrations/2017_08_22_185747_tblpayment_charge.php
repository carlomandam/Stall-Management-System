<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblpaymentCharge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tblPayment_Charge', function (Blueprint $table) {
            $table->integer('paymentID')->unsigned()->index();
            $table->integer('chargeID')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('paymentID')->references('paymentID')->on('tblPayment_Info')
              ->onDelete('cascade');
            $table->foreign('chargeID')->references('chargeID')->on('tblCharges')
              ->onDelete('cascade');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblPayment_Charge');
    }
}
