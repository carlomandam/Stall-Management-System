<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotTablestallrentalStallHAssoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('tblStallRental_StallHAssoc', function (Blueprint $table) {
            $table->integer('stallRentalID')->unsigned()->index();
            $table->integer('stallH_assocID')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stallRentalID')->references('stallRentalID')
                  ->on('tblStallRental_Info')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('stallH_assocID')->references('stallH_assocID')
                  ->on('tblStallHolderAssoc')
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
       Schema::dropIfExists('tblStallRental_StallHAssoc');
    }
}
