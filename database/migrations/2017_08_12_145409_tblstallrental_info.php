<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblstallrentalInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tblStallRental_Info', function (Blueprint $table) {
            $table->increments('stallRentID');
            $table->integer('stallHID')->unsigned();
            $table->string('stallID');
            $table->string('orgName','200')->nullable();
            $table->string('businessName')->nullable();
            $table->date('startingDate');
            $table->integer('stallRentalStatus');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stallHID')->references('stallHID')->on('tblStallHolder');
            $table->foreign('stallID')->references('stallID')->on('tblStall');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
           Schema::dropIfExists('tblStallRental_Info');
    }
}
