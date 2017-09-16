<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBillInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        // Schema::create('tblBillInfo', function (Blueprint $table){
        // $table->increments('billInfoID');
        // $table->string('billID')->unsigned();
        // $table->foreign('billID')->references('billID')
        //       ->on('tblBilling')
        //       ->onUpdate('cascade')
        //       ->onDelete('restrict');

        // $table->integer('feeID')->unsigned();
        // $table->foreign('feeID')->references('feeID')
        //       ->on('tblFees')
        //       ->onUpdate('cascade')
        //       ->onDelete('restrict');
        //     //
        // });
           

            
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        // Schema::dropIfExists('tblBillInfo');
    }
}
