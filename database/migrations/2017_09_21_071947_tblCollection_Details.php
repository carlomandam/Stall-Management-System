<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblCollectionDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('tblCollection_Details', function (Blueprint $table) {
            $table->increments('collectionDetID');
            $table->integer('collectionID')->unsigned();
            $table->date('collectDate');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('collectionID')->references('collectionID')
                  ->on('tblCollection')
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
         Schema::dropIfExists('tblCollection_Details');
    }
}
