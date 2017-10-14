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
            $table->integer('stallHID')->unsigned();
            $table->integer('requestType');
            $table->string('requestText',191)->nullable();
            $table->integer('status');
            $table->string('remarks',191)->nullable();
            $table->dateTime('approvedDate')->nullable();
             $table->dateTime('submitDate');     
            $table->timestamps();
            $table->softDeletes();
             $table->foreign('stallHID')->references('stallHID')
                    ->on('tblStallHolder') 
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
