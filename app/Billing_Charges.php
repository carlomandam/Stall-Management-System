<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;
class Billing_Charges extends Model
{
    //
    use Softdeletes;
    protected $table = "tblBilling_Charges";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'billDetID',
        'chargeDetID'
    
    ];

     public function Charge_Details(){
        return $this->hasMany('App\Charge_Details','chargeDetID');
    }
    public function Billing_Details(){
        return $this->hasMany('App\Billing_Details','billDetID');
    }
}
