<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblCharges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblCharges', function (Blueprint $table) {
            $table->increments('chargeID');
            $table->string('chargeName',200);
            $table->double('chargeAmount',10,2);
            $table->integer('chargeType'); //Fixed or Percent of Billing
            $table->string('chargeDesc',500);
            $table->timestamps();
            $table->softDeletes();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblCharges');
    }
}
