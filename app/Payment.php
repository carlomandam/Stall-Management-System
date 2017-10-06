<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class Payment extends Model
{
    //
    use Softdeletes;
    protected $table = "tblPayment";
    protected $primaryKey = "paymentID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'paymentDate',
    	'paidAmt'
    
    ];

    public function PaymentCollection()
    {
   	 return $this->belongsToMany('App\Collection','tblPayment_Collection','paymentID','collectionID');
    }
    public function Initial_Details(){
        return $this->hasMany('App\Initial_Details','paymentID');
    }
    public function Charge_Details(){
        return $this->hasMany('App\Charge_Details','paymentID');
    }

    public function Billing_Details(){
        return $this->hasMany('App\Billing_Details','paymentID');
    }

}
