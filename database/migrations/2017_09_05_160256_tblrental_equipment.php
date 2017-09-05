<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblrentalEquipment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tblRental_Equipment', function (Blueprint $table) {
            $table->increments('rentEquipmentID');
            $table->integer('stallRentalID')->unsigned();
            $table->date('rentDateOut');
            $table->date('rentDateReturned');
            $table->double('rentAmountDue',10,2);
            $table->timestamps();
            $table->softDeletes();


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
       Schema::dropIfExists('tblRental_Equipment');
    }
}
