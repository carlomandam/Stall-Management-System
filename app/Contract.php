<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
   protected $table = "tblContractInfo";
    protected $primaryKey = "contractID";
  	//protected $fillable = array('rentID', 'contractLength', 'contractStatus'); 
  public function contractPeriods(){
        return $this->belongsToMany('App\ContractPeriod','tblContractInfo', 'contractID', 'contractLengthID')->withPivot('contractLengtNumber');
    }

    public function StallRental(){
        return $this->hasMany('App\StallRental','stallRentID');
    }

}
