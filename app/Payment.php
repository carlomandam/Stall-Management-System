<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    protected $table = "tblPayment_Info";
    protected $primaryKey = "paymentID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'paymentStatus'];
   
     public function Billing()
     {
     	return $this->belongsTo('App\Billing','billID');
     }
     
     public function PaymentHistory()
     {
     	return $this->hasMany('App\PaymentHistory','paymentID');
     }
    
}
