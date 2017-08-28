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
            $table->integer('requestType');
            $table->string('requestText',300)->nullable();
            $table->integer('status');
<<<<<<< HEAD
            $table->integer('requestType');
            $table->string('remarks',200)->nullable();
            $table->dateTime('submitDate');
            $table->dateTime('approvedDate')->nullable();
            $table->string('requestText',300)->nullable();
=======
            $table->string('remarks',200)->nullable();
            $table->dateTime('submitDate');
            $table->dateTime('approvedDate')->nullable();
            
>>>>>>> c19182f945fc63078981ae1cf252cf11aff53171
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
