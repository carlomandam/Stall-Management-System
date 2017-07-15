<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractInfo extends Model
{
    
    protected $table = "tblcontract_info";
    protected $primaryKey = "contract_infoID";
  
    public function ContractPeriod(){
        return $this->belongsTo('App\ContractPeriod','contract_periodID');
    }
    public function Contract(){
        return $this->belongsTo('App\Contract','contractID');
    }

}
