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
    
    public function Billing(){
        return $this->belongsToMany('App\Billing','tblBill_Charges','chargeID','billID');
    }
    public function Charge_Details(){
        return $this->hasMany('App\Charge_Details','chargeID');
    }
}
