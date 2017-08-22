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
    {
       Schema::create('tblCollection_Info', function (Blueprint $table) {
            $table->increments('collectionID');
            $table->integer('stallRentID')->unsigned()->index();
            $table->integer('collectionType'); //0-security deposit, 1-stall maintenance fee, 2-rental rate
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stallRentID')->references('stallRentID')->on('tblStallRental_Info')
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
