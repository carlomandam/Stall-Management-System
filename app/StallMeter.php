<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;
class StallMeter extends Model
{
    //
    use Softdeletes;
    protected $table = "tblStallUtilities_MeterID";
    protected $primaryKey = "stallMeterID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'contractID',
    	'readingID',
    	'utilityAmt'
    
    ];

    public function MonthlyReading(){
    	return $this->belongsTo('App\MonthlyReading','readingID');
    }
    public function Contract(){
    	return $this->belongsTo('App\Contract','contractID');
    }

    public function Billing_Utilities(){
        return $this->belongsToMany('App\Billing_Details','tblBilling_Utilities','stallMeterID',
            'billDetID');
    }


}
