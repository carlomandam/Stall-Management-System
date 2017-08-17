<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractPeriod extends Model
{
    
    protected $table = "tblContract_Length";
    protected $primaryKey = "contractLengthID";
    protected $dates = ['deleted_at'];
    
        public function ContractInfo(){
        return $this->belongsTo('App\ContractInfo','contract_periodID');
    }
    
 	
}
