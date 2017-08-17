<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblUtilities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblUtilities', function (Blueprint $table) {
            $table->string('initialFeeDesc',200);
            $table->double('initialAmt',10,2);
            $table->string('vendorCollectionStatusName',200);
            $table->double('vendorCollectionMaxDebtAmt',10,2);
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
        Schema::dropIfExists('tblUtilities');
    }
}
