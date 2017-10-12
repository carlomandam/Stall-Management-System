<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBillingCharges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tblBilling_Charges', function (Blueprint $table) {
            $table->integer('billDetID')->unsigned();
            $table->integer('chargeDetID')->unsigned();

            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('chargeDetID')
                 ->references('chargeDetID')
                 ->on('tblCharge_Details')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');

            $table->foreign('billDetID')
                 ->references('billDetID')
                 ->on('tblBilling_Details')
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
         Schema::dropIfExists('tblBilling_Charges');
    }
}
