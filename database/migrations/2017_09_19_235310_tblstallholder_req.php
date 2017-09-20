<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblstallholderReq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblstallholder_req', function (Blueprint $table) {
            $table->integer('stallHID')->unsigned();
            $table->integer('reqID')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stallHID')
                 ->references('stallHID')
                 ->on('tblstallholder')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');
            $table->foreign('reqID')
                 ->references('reqID')
                 ->on('tblRequirements')
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
        Schema::dropIfExists('tblstallholder_req');
    }
}
