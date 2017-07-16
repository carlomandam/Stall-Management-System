<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
   protected $table = "tblcontract";
    protected $primaryKey = "contractID";
  
  public function ContractInfo(){
        return $this->hasMany('App\ContractInfo','contractID');
    }
}
