<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class TblcontractInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblContractInfo', function (Blueprint $table) {
            $table->increments('contractID');
            $table->integer('stallRentalID')->unsigned()->index();
            $table->date('contractStart');
            $table->date('contractEnd');
            $table->integer('stallRateID')->unsigned();
            $table->integer('collectionType')->unsigned();//1-Monthly 2-Weekly 3-Daily
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('stallRentalID')->references('stallRentalID')
                  ->on('tblStallRental_Info')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('stallRateID')->references('stallRateID')
                  ->on('tblStallRate')
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
        Schema::dropIfExists('tblContractInfo');
    }
}