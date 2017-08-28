<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBillCharge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblBill_Charge', function (Blueprint $table) {
            $table->integer('billID')->unsigned()->index();
            $table->integer('chargeID')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('billID')->references('billID')
                  ->on('tblBilling_Info')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('chargeID')->references('chargeID')
                  ->on('tblCharges')
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
        Schema::dropIfExists('tblBill_Charge');
    }
}
