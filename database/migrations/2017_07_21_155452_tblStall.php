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
            $table->string('ID')->primary();
            $table->integer('bldgID')->unsigned();
            $table->string('Level',200);
            $table->string('Description',200)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('bldgID')->references('ID')->on('tblbuilding');
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
