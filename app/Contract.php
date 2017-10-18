<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;
    
    protected $table = "tblContractInfo";
    protected $primaryKey = "contractID";
    protected $fillable = array('stallRentalID', 'contractLengthID', 'contractStatus','contractStart','contractEnd'); 
    protected $softDelete = true;

    public function StallHolder(){
        return $this->belongsTo('App\StallHolder','stallHID');
    }

    public function Stall(){
        return $this->belongsTo('App\Stall','stallID');
    }

    public function StallRate(){
        return $this->belongsTo('App\StallRate','stallRateID');
    }

    public function Billing(){
        return $this->hasMany('App\Billing','billID');
    }

    public function UtilityMeterID(){
        return $this->hasMany('App\UtilityMeterID','contractID','stallMeterID');
    }

    public function UnbilledUtilities(){
        return $this->hasMany('App\UtilityMeterID','contractID')->doesntHave('Billing');
    }

    public function BilledUtilities(){
        return $this->hasMany('App\UtilityMeterID','contractID')->has('Billing');
    }

    public function Charges(){
        return $this->hasMany('App\Charge_Details','contractID');
    }

    public function PrevContract(){
        return $this->belongsTo('App\Contract','prevContractID');
    }

    public function NextContract(){
        return $this->hasOne('App\Contract','prevContractID');
    }

    public function Collection(){
        return $this->hasMany('App\Collection','contractID');
    }

    public function Initial_Details(){
        return $this->hasMany('App\InitFeeDetail','contractID');
    }
    public function StallMeter(){
        return $this->hasMany('App\StallMeter','contractID');
    }

    public function UnpaidInitial(){
        return $this->hasMany('App\InitFeeDetail','contractID')->whereNull('transactionID');
    }

    public function Product(){
        return $this->belongsToMany('App\Product','tblcontract_product','contractID','productID');
    }
}
