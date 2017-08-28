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
         Schema::create('tblBilling_Info', function (Blueprint $table) {
            $table->increments('billID');
            $table->date('billDateFrom');
            $table->date('billDateTo');
            $table->date('billDueDate');

            $table->integer('stallRentalID')->unsigned()->index();

            $table->foreign('stallRentalID')
                 ->references('stallRentalID')
                 ->on('tblStallRental_Info')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');

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
         Schema::dropIfExists('tblBilling_Info');
    }
}
