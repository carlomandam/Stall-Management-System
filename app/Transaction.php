<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class Transaction extends Model
{
    //
     use Softdeletes;
    protected $table = "tblPayment_Transaction";
    protected $primaryKey = "transactionID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'transactionDate'
    
    ];

    public function Billing_Details(){
    	return $this->hasMany('App\Billing_Details','transactionID');
    }
    public function Charge_Details(){
    	return $this->hasMany('App\Charge_Details','transactionID');
    }
    public function Initial_Details(){
    	return $this->hasMany('App\InitFeeDetail','transactionID');
    }
    public function PaymentCollection()
    {
   	 return $this->belongsToMany('App\Collection','tblPayment_Collection','transactionID','collectionID');
    }
    public function Payment()
    {
      return $this->belongsTo('App\Payment','paymentID');
    }

   
    
}
