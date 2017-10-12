<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBillingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tblBilling_Details', function (Blueprint $table) {
            $table->increments('billDetID');
            $table->integer('billID')->unsigned();
            $table->integer('transactionID')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('billID')
                 ->references('billID')
                 ->on('tblBilling')
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
         Schema::dropIfExists('tblBilling_Details');
    }
}
