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
        Schema::create('tblPayment_Ref', function (Blueprint $table) {
            $table->integer('paymentID')->unsigned()->index();
            $table->integer('billID')->unsigned()->index();

            $table->foreign('billID')
                 ->references('billID')
                 ->on('tblBilling_Info')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');

            $table->foreign('paymentID')
                 ->references('paymentID')
                 ->on('tblPayment')
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
