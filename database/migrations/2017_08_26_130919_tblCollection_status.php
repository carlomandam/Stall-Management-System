<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblCollectionStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblCollection_Status', function (Blueprint $table) {
            $table->increments('collectionID');
            $table->string('collectionStatusName');
            $table->string('collectionStatusColor')->nullable();
            $table->double('collectionDebtAmt',10,2);
         
            $table->timestamps();
            $table->softDeletes();
            
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblCollection_Status');
    }
}
