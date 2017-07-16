<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractPeriod extends Model
{
    
    protected $table = "tblcontract_period";
    protected $primaryKey = "contract_periodID";
    protected $dates = ['deleted_at'];
    
        public function ContractInfo(){
        return $this->hasMany('App\ContractInfo','contract_periodID');
    }
    
 	
}
