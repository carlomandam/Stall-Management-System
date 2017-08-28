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
            $table->integer('stallRentalID')->unsigned()->index();
            $table->integer('productID')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stallRentalID')->references('stallRentalID')
                  ->on('tblStallRental_Info')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('productID')->references('productID')
                  ->on('tblProduct')
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
        Schema::dropIfExists('tblStallRental_Product');
    }
}
