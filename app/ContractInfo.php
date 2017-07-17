<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractInfo extends Model
{
    
    protected $table = "tblcontract_info";
    protected $primaryKey = "contract_infoID";
   public $timestamps = false;
    public function ContractPeriod(){
        return $this->hasMany('App\ContractPeriod','contract_periodID');
    }
    public function Contract(){
        return $this->hasMany('App\Contract','contractID');
    }

}
