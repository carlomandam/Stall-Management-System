<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
   protected $table = "tblcontract";
    protected $primaryKey = "contractID";
    public $timestamps = false;
  	//protected $fillable = array('rentID', 'contractLength', 'contractStatus'); 
  public function ContractInfo(){
        return $this->belongsTo('App\ContractInfo','contractID');
    }

    public function Rent(){
        return $this->hasMany('App\Rent','rentID');
    }

}
