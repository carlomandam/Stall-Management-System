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
            $table->increments('ID');
            $table->string('FirstName',200);
            $table->string('LastName',200);
            $table->string('MiddleName',200)->nullable();
            $table->dateTime('BirthDay');
            $table->string('ContactNo',13);
            $table->string('Email',200);
            $table->string('Address',500);
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
