<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblRequestInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('tblRequestInfo', function (Blueprint $table) {
            $table->increments('reqInfoID');
            $table->integer('requestID')->unsigned();
            $table->string('stallRequested',20)->nullable();
            $table->integer('contractID')->unsigned();
            $table->softDeletes();


             $table->foreign('requestID')->references('requestID')
                   ->on('tblRequest') 
                   ->onUpdate('cascade')
                   ->onDelete('restrict');
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
        Schema::dropIfExists('tblRequestInfo');
    }
}
