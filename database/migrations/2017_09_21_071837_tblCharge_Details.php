<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblChargeDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tblCharge_Details', function (Blueprint $table) {
            $table->increments('chargeDetID');
            $table->integer('chargeID')->unsigned();
            $table->integer('contractID')->unsigned();
            $table->integer('transactionID')->unsigned()->nullable();
          
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('contractID')
                 ->references('contractID')
                 ->on('tblContractInfo')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');

            $table->foreign('chargeID')
                 ->references('chargeID')
                 ->on('tblCharges')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');

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
         Schema::dropIfExists('tblCharge_Details');
    }
}
