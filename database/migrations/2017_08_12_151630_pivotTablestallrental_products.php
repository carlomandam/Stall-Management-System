<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotTablestallrentalProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblStallRental_Product', function (Blueprint $table) {
            $table->integer('stallRentID')->unsigned()->index();
            $table->integer('productID')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stallRentID')->references('stallRentID')->on('tblStallRental_Info')
              ->onDelete('cascade');
            $table->foreign('productID')->references('productID')->on('tblProduct')
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
        Schema::dropIfExists('tblStallRental_Product');
    }
}
