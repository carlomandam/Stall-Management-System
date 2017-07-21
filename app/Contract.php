<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
   protected $table = "tblcontract";
    protected $primaryKey = "contractID";
    public $timestamps = false;
  	//protected $fillable = array('rentID', 'contractLength', 'contractStatus'); 
  public function contractPeriods(){
        return $this->belongsToMany('App\ContractPeriod','tblcontract_info', 'contractID', 'contractPeriodID')->withPivot('contractLength');
    }

    public function Rent(){
        return $this->hasMany('App\Rent','rentID');
    }

}
