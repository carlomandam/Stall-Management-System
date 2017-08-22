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
       Schema::create('tblPayment_History', function (Blueprint $table) {
            $table->increments('paymentHistoryID');
            $table->integer('paymentID')->unsigned()->index();
            $table->double('paymentAmt');
            $table->date('paymentDate');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('paymentID')->references('paymentID')->on('tblPayment_Info')
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
       
      Schema::dropIfExists('tblPayment_History');
    }
}
