<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPaymentCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tblPayment_Collection', function (Blueprint $table) {
            $table->integer('paymentID')->unsigned();
            $table->integer('collectionID')->unsigned();
            $table->tinyInteger('collectionStatus');
            //1- full 
            //2- partial
            //3- advance
            $table->timestamps();
            $table->softDeletes();

             $table->foreign('paymentID')
                 ->references('paymentID')
                 ->on('tblPayment')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');
             $table->foreign('collectionID')
                 ->references('collectionID')
                 ->on('tblCollection')
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
         Schema::dropIfExists('tblPayment_Collection');
    }
}
