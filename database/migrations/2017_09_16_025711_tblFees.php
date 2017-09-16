<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tblFees', function (Blueprint $table) {
            $table->increments('feeID');
            $table->string('feeDesc');
            $table->double('feeAmount',10,2);
            $table->date('feeDate');
            $table->integer('feeStatus');
            $table->integer('contractID')->unsigned();
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
        Schema::dropIfExists('tblFees');
    }
}
