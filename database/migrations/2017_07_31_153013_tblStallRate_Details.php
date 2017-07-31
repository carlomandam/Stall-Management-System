<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblStallRateDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblStallRate_Details', function (Blueprint $table) {
            
            $table->integer('stallRateID')->unsigned()->index();
            $table->integer('stallRateDesc'); // 1- if Monday 2- Tues or 1- if weekly,monthly,etc.
            $table->double('dblRate');
            $table->timestamps();
            $table->softDeletes();
             
            $table->foreign('stallRateID')->references('stallRateID')->on('tblStallRate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {  

      Schema::dropIfExists('tblstallRate_Details');
       
    }
}
