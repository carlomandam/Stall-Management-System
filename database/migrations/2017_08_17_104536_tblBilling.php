<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBilling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('tblBilling', function (Blueprint $table) {
            $table->increments('billingID');
            $table->integer('stallRentalID')->unsigned()->index();
            $table->date('billDueDate');
            $table->datetime('billDate');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stallRentalID')->references('stallRentalID')->on('tblStallRental_Info')
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
         Schema::dropIfExists('tblBilling');
    }
}
