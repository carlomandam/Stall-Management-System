<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillPayment extends Model
{
    //
    use SoftDeletes;
    
    protected $table = "tblBill_Payment";
    protected $primaryKey = "billPaymentID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'billID',
    	'paidAmt',
    	'paidDate'
    ];
    
    public function Billing(){
        return $this->belongsToMany('App\Billing','tblBill_Payment','billPaymentID','billID');
    }
}
