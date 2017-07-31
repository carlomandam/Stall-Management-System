<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblStall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblStall', function (Blueprint $table) {
            $table->string('stallID')->primary();
            $table->integer('bldgID')->unsigned();
            $table->string('Level',200);
            $table->string('stallDesc',200)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('bldgID')->references('bldgID')->on('tblBuilding');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblStall');
    }
}
