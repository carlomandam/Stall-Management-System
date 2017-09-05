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
            $table->integer('stallRateDesc'); // 1- if Monday 2- Tues 
            $table->tinyInteger('stallRateType');//if Percentage or Amount yung increase
            $table->double('dblRate'); //10% or 200 pesos ganern
            $table->timestamps();
            $table->softDeletes();
             
            $table->foreign('stallRateID')->references('stallRateID')
                  ->on('tblStallRate')
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

      Schema::dropIfExists('tblstallRate_Details');
       
    }
}
