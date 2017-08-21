<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charges extends Model
{
    use SoftDeletes;
    
    protected $table = "tblCharges";
    protected $primaryKey = "chargeID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'chargeName',
    	'chargeAmount',
    	'chargeType'
    ];
    
    /*public function Bill(){
        return $this->belongsToMany('App\Bill','bldgID');
    }*/
}
