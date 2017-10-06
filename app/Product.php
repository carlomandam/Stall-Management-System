<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "tblProduct";
    protected $primaryKey = "productID";
    protected $dates = ['deleted_at'];
    public $timestamps = false;
    
    public function Contract(){
        return $this->belongsToMany('App\Contract','tblcontract_product','productID','contractID');
    }
}
