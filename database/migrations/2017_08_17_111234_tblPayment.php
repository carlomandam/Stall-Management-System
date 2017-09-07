<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPayment extends Migration
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
            $table->integer('paymentStatus'); 
            $table->integer('billID')->unsigned()->index();

            $table->foreign('billID')
                 ->references('billID')
                 ->on('tblBilling_Info')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');
                 
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
