<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;
    
    protected $table = "tblContractInfo";
    protected $primaryKey = "contractID";
    protected $fillable = array('stallRentalID', 'contractLengthID', 'contractStatus'); 
    protected $softDelete = true;
    
    public function ContractLength(){
        return $this->belongsTo('App\ContractLength','contractLengthID');
    }
    public function StallRental(){
        return $this->belongsTo('App\StallRental','stallRentalID');
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
    public function PrevContract(){
        return $this->belongsTo('App\Contract','prevContractID');
    }
    public function StallHolder(){
         return $this->belongsTo('App\StallHolder','stallHID');
    }


    public function Collection(){
        return $this->hasMany('App\Collection','contractID');
    }
    public function Initial_Details(){
        return $this->hasMany('App\Initial_Details','contractID');
    }


}
