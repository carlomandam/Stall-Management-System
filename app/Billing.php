<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
     use SoftDeletes;
    
    protected $table = "tblBilling_Info";
    protected $primaryKey = "billID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'billDateFrom',
        'billDateTo',
        'stallRentalID'
    ];
    
   public function Payment()
   {
   	return $this->hasMany('App\Payment','billID');
   }

   public function StallRental()
   {
    return $this->belongsTo('App\StallRental','stallRentalID');
   }

}
