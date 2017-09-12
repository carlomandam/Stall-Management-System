<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class TblPaymentInfo extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

       Schema::create('tblPayment_info', function (Blueprint $table) {

            $table->increments('paymentID');
            $table->double('paymentAmt',10,2);
            $table->date('paymentDate');
            $table->timestamps();
            $table->softDeletes();

         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
      Schema::dropIfExists('tblPayment_info');
    }
}
