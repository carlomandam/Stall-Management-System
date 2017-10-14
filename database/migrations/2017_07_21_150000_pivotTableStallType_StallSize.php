<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotTableStallTypeStallSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblstallType_stallSize', function (Blueprint $table){
        $table->increments('stype_SizeID');
        $table->integer('stypeID')->unsigned()->index();
        $table->foreign('stypeID')->references('stypeID')
              ->on('tblStallType')
              ->onUpdate('cascade')
              ->onDelete('restrict');

        $table->integer('stypeSizeID')->unsigned()->index();
        $table->string('stype_SizedColor')->nullable();

        $table->foreign('stypeSizeID')->references('stypeSizeID')
              ->on('tblStallType_Size')
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
        Schema::dropIfExists('tblstallType_stallSize');
    }
}
