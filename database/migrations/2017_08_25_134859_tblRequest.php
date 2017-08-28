<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('tblRequest', function (Blueprint $table) {
            $table->increments('requestID');
            $table->integer('stallRentalID')->unsigned();
            $table->integer('status');
            $table->integer('requestType');
            $table->string('remarks',200)->nullable();
            $table->dateTime('submitDate');
            $table->dateTime('approvedDate')->nullable();
            $table->string('requestText',300)->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        //
        Schema::dropIfExists('tblRequest');
    }
}
