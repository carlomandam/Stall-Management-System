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
        Schema::create('tblPayment_info', function (Blueprint $table) {
            $table->increments('paymentID');
            $table->integer('billingID')->unsigned()->index();
            $table->integer('paymentType'); //Full, Partial, Others(Specific Amount)
            $table->double('paymentAmtPaid',10,2);
            $table->datetime('paymentDate'); 
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('billingID')->references('billingID')->on('tblBilling')
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
        Schema::dropIfExists('tblPayment_info');
    }
}
