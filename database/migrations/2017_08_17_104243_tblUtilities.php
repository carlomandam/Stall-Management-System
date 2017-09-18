<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblUtilities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblUtilities', function (Blueprint $table) {
            $table->string('utilitiesID')->primary();
            $table->string('utilitiesDesc',500)->nullable();
            //Initial Fee
            $table->double('secAmount',10,2)->nullable();
            $table->double('mainAmount',10,2)->nullable();
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
        Schema::dropIfExists('tblUtilities');
    }
}
