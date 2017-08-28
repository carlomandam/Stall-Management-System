<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblStallRentalRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblStallRental_Requirements', function (Blueprint $table) {
            $table->integer('reqID')->unsigned();
            $table->integer('stallRentalID')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('reqID')->references('reqID')
                  ->on('tblRequirements')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('stallRentalID')->references('stallRentalID')
                  ->on('tblStallRental_Info')
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
        Schema::dropIfExists('tblStallRental_Requirements');
    }
}
