<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblInitialDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('tblInitial_Details', function (Blueprint $table) {
            $table->increments('initDetID');
            $table->integer('initID')->unsigned();
            $table->integer('transactionID')->unsigned();
            $table->integer('contractID')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('initID')
                 ->references('initID')
                 ->on('tblInitialFees')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');

            $table->foreign('contractID')
                 ->references('contractID')
                 ->on('tblContractInfo')
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
        Schema::dropIfExists('tblInitial_Details');
    }
}
