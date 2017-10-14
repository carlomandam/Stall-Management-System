<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class Billing_Details extends Model
{
    //
      use Softdeletes;
    protected $table = "tblBilling_Details";
    protected $primaryKey = "billDetID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'billID',
        'transactionID'
    
    ];

    public function Transaction(){
    	return $this->belongsTo('App\Transaction','transactionID');
    }
    public function Billing(){
    	return $this->belongsTo('App\Billing_Details','billID');
    }
    public function Billing_Utilities(){
        return $this->belongsToMany('App\StallMeter','tblBilling_Utilities',
            'billDetID','stallMeterID');
    }
    public function Billing_Charges(){
        return $this->belongsToMany('App\Billing_Details','tblBilling_Charges','billDetID','chargeDetID');
    }
    



}
