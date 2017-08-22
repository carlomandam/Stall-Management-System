<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblpaymentCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tblPayment_Collection', function (Blueprint $table) {
            $table->integer('paymentID')->unsigned()->index();
            $table->integer('collectionID')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('paymentID')->references('paymentID')->on('tblPayment_Info')
              ->onDelete('cascade');
            $table->foreign('collectionID')->references('collectionID')->on('tblCollection_Info')
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
         Schema::dropIfExists('tblPayment_Collection');
    }
}
