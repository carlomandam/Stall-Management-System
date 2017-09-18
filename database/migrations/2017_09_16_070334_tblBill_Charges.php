<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBillCharges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tblBill_Charges', function (Blueprint $table) {
            $table->increments('billChargeID');
            $table->integer('chargeID')->unsigned();
            $table->integer('billID')->unsigned();
       
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('chargeID')
                 ->references('chargeID')
                 ->on('tblCharges')
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
         Schema::dropIfExists('tblBill_Charges');
    }
}
