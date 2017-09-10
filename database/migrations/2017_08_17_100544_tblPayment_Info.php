<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPaymentHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tblPayment', function (Blueprint $table) {
            $table->increments('paymentID');
            $table->double('paymentAmt',10,2);
            $table->date('paymentDate');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('paymentID')->references('paymentID')
                  ->on('tblPayment_Info')
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
       
      Schema::dropIfExists('tblPayment_History');
    }
}
