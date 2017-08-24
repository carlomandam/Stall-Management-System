<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_Collection extends Model
{
     protected $table = "tblPayment_Collection";
   
     public function Collection()
     {
     	return $this->belongsTo('App\Payment','collectionID');
     }
     
     public function Payment()
     {
     	return $this->belongsTo('App\Payment','paymentID');
     }
}
