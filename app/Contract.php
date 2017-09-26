<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Contract extends Model
{
    protected $table = "tblContractInfo";
    protected $primaryKey = "contractID";
    protected $fillable = array('stallRentalID', 'contractLengthID', 'contractStatus'); 
    
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



}
