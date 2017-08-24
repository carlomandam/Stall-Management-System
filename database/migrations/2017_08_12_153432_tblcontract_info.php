<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblcontractInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblContractInfo', function (Blueprint $table) {
            $table->increments('contractID');

            $table->integer('stallRentID')->unsigned()->index();
            $table->date('contractStart');
            $table->date('contractEnd');
            $table->integer('contractLengthNumber');

            $table->integer('stallRentalID')->unsigned()->index();
            $table->date('contractStart');
            $table->date('contractEnd');

            $table->softDeletes();
            $table->timestamps();


            $table->foreign('stallRentID')->references('stallRentID')->on('tblStallRental_Info')

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
        Schema::dropIfExists('tblContractInfo');
    }
}
