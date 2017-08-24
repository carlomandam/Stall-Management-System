<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = "tblContractInfo";
    protected $primaryKey = "contractID";

  	protected $fillable = array('stallRentID', 'contractLengthID', 'contractStatus'); 

  	protected $fillable = array('stallRentalID', 'contractLengthID', 'contractStatus'); 

    
    public function ContractLength(){
        return $this->belongsTo('App\ContractLength','contractLengthID');
    }

    public function StallRental(){

        return $this->belongsTo('App\StallRental','stallRentID');

        return $this->belongsTo('App\StallRental','stallRentalID');

    }

}
