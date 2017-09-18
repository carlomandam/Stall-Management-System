<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBillPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('tblBill_Payment', function (Blueprint $table) {
            $table->increments('billPaymentID');
            $table->integer('billID')->unsigned();
            $table->double('paidAmt',10,2);
            $table->date('paidDate');

       
            $table->timestamps();
            $table->softDeletes();
            
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
         Schema::dropIfExists('tblBill_Payment');
    }
}
