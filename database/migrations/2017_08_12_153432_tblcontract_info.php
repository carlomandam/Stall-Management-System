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
            $table->integer('prevContractID')->unsigned()->index()->nullable();
            $table->integer('stallHID')->unsigned()->index();
            $table->string('stallID')->index();
            $table->string('orgName')->nullable();
            $table->string('businessName');
            $table->date('contractStart')->nullable();
            $table->date('contractEnd')->nullable();
            $table->string('contractReason')->nullable();
            $table->integer('stallRateID')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('stallRateID')->references('stallRateID')
                  ->on('tblStallRate')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('prevContractID')->references('contractID')
                  ->on('tblContractInfo')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('stallHID')->references('stallHID')
                  ->on('tblStallHolder')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('stallID')->references('stallID')
                  ->on('tblStall')
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