<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('tblCollection', function (Blueprint $table) {
            $table->increments('collectionID');
            $table->integer('contractID')->unsigned();
            $table->date('collectionDate');
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
        Schema::dropIfExists('tblCollection');
    }
}
