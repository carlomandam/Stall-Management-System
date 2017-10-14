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
            $table->integer('floorID')->unsigned();
            $table->integer('stype_SizeID')->unsigned()->nullable();
            $table->text('stallDesc')->nullable();
            $table->integer('stallStatus')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('floorID')->references('floorID')
                  ->on('tblFloor')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('stype_SizeID')->references('stype_SizeID')
                  ->on('tblstallType_stallSize')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
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
