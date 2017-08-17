<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBillingCharges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblBilling_Charges', function (Blueprint $table) {
            $table->integer('billingID')->unsigned()->index();
            $table->integer('chargeID')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('billingID')->references('billingID')->on('tblBilling')
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
         Schema::dropIfExists('tblBilling_Charges');
    }
}
