<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "tblProduct";
    protected $primaryKey = "productID";
    protected $dates = ['deleted_at'];
    public $timestamps = false;
    
    public function StallRental(){
        return $this->belongsToMany('App\StallRental','tblstallrental_product','productID','stallRentalID');
    }
}
