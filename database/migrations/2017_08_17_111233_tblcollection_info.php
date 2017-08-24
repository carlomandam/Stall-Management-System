<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblcollectionInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
/* HEAD:database/migrations/2017_08_17_104536_tblBilling.php
    { 
        Schema::create('tblBilling', function (Blueprint $table) {
            $table->increments('billingID');
            $table->integer('stallRentalID')->unsigned()->index();
            $table->date('billDueDate');
            $table->datetime('billDate');*/
    {
       Schema::create('tblCollection_Info', function (Blueprint $table) {
            $table->increments('collectionID');
            $table->integer('stallRentalID')->unsigned()->index();
            $table->integer('collectionType'); //0-security deposit, 1-stall maintenance fee, 2-rental rate
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
       Schema::dropIfExists('tblCollection_Info');
    }
}
