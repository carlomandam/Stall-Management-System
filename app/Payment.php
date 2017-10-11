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
    	'paidAmt',
        'transactionID'
    
    ];

    public function Transaction()
    {
   	 return $this->hasMany('App\Transaction','paymentID');
    }
   

}
