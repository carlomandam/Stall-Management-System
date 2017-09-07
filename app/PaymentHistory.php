<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentHistory extends Model
{
     protected $table = "tblPayment_History";
    protected $primaryKey = "paymentHistoryID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'paymentAmt'];
   
     public function Payment()
     {
     	return $this->belongsTo('App\Payment','paymentID');
     }
}
