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
   	 return $this->belongsToMany('App\Collection','tblPayment_Collection','paymentID','collectionDetID');
    }

}
