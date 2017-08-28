<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBillInitialFee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tblBill_InitialFee', function (Blueprint $table) {
            $table->integer('billID')->unsigned()->index();
            $table->integer('initialFeeID')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('billID')->references('billID')
                  ->on('tblBilling_Info')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('initialFeeID')->references('initialFeeID')
                  ->on('tblUtilities_Initial')
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
        Schema::dropIfExists('tblBill_InitialFee');
    }
}
