<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContractProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblContract_Product', function (Blueprint $table) {
            $table->integer('contractID')->unsigned();
            $table->integer('productID')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('contractID')->references('contractID')
                  ->on('tblContractInfo')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('productID')->references('productID')
                  ->on('tblProduct')
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
        Schema::dropIfExists('tblStallRental_Product');
    }
}
