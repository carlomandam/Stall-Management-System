<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBilling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tblBilling', function (Blueprint $table) {
            $table->increments('billID');
            $table->integer('contractID')->unsigned();
            $table->tinyInteger('billStatus');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('contractID')
                 ->references('contractID')
                 ->on('tblContractInfo')
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
        //
        Schema::dropIfExists('tblBilling');
    }
}
