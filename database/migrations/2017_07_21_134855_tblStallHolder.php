<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblStallHolder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblStallHolder', function (Blueprint $table) {
            $table->increments('stallHID');
            $table->string('stallHFName',200);
            $table->string('stallHMName',200)->nullable();
            $table->string('stallHLName',200);
            $table->date('stallHBday');
            $table->integer('stallHSex');
            $table->string('stallHEmail',200);
            $table->string('stallHAddress',500);
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
        Schema::dropIfExists('tblStallHolder');
    }
}
