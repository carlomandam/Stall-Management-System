<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBillInitial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('tblBill_Initial', function (Blueprint $table) {
            $table->increments('billInitialID');
            $table->integer('billID')->unsigned();
            $table->double('initialAmt',10,2);
            $table->tinyInteger('initialType');
            $table->timestamps();
            $table->softDeletes();
            
     
            $table->foreign('billID')
                 ->references('billID')
                 ->on('tblBilling')
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
            Schema::dropIfExists('tblBill_Initial');
    }
}
