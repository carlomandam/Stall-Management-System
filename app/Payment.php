<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
     protected $table = "tblPayment_Info";
   
     public function Collection()
     {
     	return $this->hasMany('App\Collection','collectionID');
     }
     
    
}
