<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotTablestallrentalContactnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblStallRental_ContactNos', function (Blueprint $table) {
            $table->integer('stallRentID')->unsigned()->index();
            $table->integer('contactID')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stallRentID')->references('stallRentID')->on('tblStallRental_Info')
              ->onDelete('cascade');
            $table->foreign('contactID')->references('contactID')->on('tblContactNos')
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
        
        Schema::dropIfExists('tblStallRental_ContactNos');
    }
}
