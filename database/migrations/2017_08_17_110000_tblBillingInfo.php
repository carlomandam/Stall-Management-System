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
            $table->double('prevBal',10,2)->default('0'); //faster fetch of data, no need to check previous transaction kung may di nabayaran, select MAX data dito tapos oks na yon basta tama insert ehehhe
            $table->double('curBal',10,2);
            $table->date('billDateFrom');
            $table->date('billDateTo');
            $table->date('billDueDate')->nullable();
            $table->tinyInteger('isSecurityDeposit')->default('0'); //Insert 1 if for security deposit//

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
