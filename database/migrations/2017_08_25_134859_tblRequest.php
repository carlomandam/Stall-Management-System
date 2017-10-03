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
            $table->integer('contractID')->unsigned();
            $table->integer('requestType');
            $table->string('requestText',300)->nullable();
            $table->integer('status');
            $table->string('remarks',200)->nullable();
            $table->dateTime('approvedDate')->nullable();     
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('contractID')->references('contractID')
                    ->on('tblContractInfo') 
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
