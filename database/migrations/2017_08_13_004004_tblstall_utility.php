<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblstallUtility extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblStall_Utilities', function (Blueprint $table) {
            $table->increments('stallUtilityID');
            $table->string('stallID')->index();
            $table->integer('utilityType'); //1-Electricity // 2-water
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stallID')->references('stallID')->on('tblStall')->onDelete('cascade');
            
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblStall_Utilities');
    }
}
