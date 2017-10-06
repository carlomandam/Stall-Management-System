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
    	'paymentID',
    	'stallMeterID'
    
    ];

    public function Payment(){
    	return $this->belongsTo('App\Payment','paymentID');
    }
    public function StallMeter(){
    	return $this->belongsTo('App\StallMeter','stallMeterID');
    }
    public function Billing(){
    	return $this->belongsTo('App\Billing_Details','billID');
    }
    



}
