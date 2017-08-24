<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tblcontactnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tblContactNos', function (Blueprint $table) {
            $table->increments('contactID');
            $table->integer('stallHID')->unsigned();
            $table->string('contactNumber','20');
            $table->softDeletes();
            
            $table->foreign('stallHID')->references('stallHID')->on('tblStallHolder')
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
        Schema::dropIfExists('tblContactNos');
    }
}
