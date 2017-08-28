<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblRequestInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('tblRequestInfo', function (Blueprint $table) {
            $table->integer('requestID')->unsigned();
            $table->string('stallRequested',20);
            $table->softDeletes();
<<<<<<< HEAD

             $table->foreign('requestID')->references('requestID')
                   ->on('tblRequest') 
                   ->onUpdate('cascade')
                   ->onDelete('restrict');
=======
            $table->foreign('requestID')->references('requestID')->on('tblRequest');
>>>>>>> c19182f945fc63078981ae1cf252cf11aff53171
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
        Schema::dropIfExists('tblRequestInfo');
    }
}
