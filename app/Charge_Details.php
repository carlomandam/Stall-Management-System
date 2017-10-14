<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class Charge_Details extends Model
{
    //
     use Softdeletes;
    protected $table = "tblCharge_Details";
    protected $primaryKey = "chargeDetID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'chargeID',
	    'contractID',
        'chargeAmt',
        'chargeDesc'

    
    ];

    public function Charges(){
        return $this->belongsTo('App\Charges','chargeID');
    }
    public function Contract(){
    	return $this->belongsTo('App\Contract','contractID');
    }
    public function Billing_Charges(){
        return $this->belongsToMany('App\Billing_Details','tblBilling_Charges','chargeDetID','billDetID');
    }
    

}
