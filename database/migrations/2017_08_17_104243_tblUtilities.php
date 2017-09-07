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
            $table->increments('utilitiesID'); //1 market days, 2 pickrates,
            $table->string('utilitiesDesc',500)->nullable();
            $table->integer('peakType')->nullable();//0 for fixed 1 for percent 3 for multiplier
            $table->integer('peakQuan')->nullable();
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
