<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBillRentEquipment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblBill_RentEquipment', function (Blueprint $table) {
            $table->increments('billRentEquipID');
            $table->integer('billID')->unsigned()->index();
            $table->integer('stallRentalID')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('billID')->references('billID')
                  ->on('tblBilling_Info')
                  ->onUpdate('cascade')
                 ->onDelete('restrict');

            $table->foreign('stallRentalID')->references('stallRentalID')
                  ->on('tblStallRental_Info')
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
          Schema::dropIfExists('tblBill_RentEquipment');
    }
}
