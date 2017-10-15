<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UtilityMeterID extends Model{
    //
    use SoftDeletes;
    
    protected $table = "tblStallUtilities_MeterID";
    protected $primaryKey = "stallMeterID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'contractID',
    	'readingID',
    	'utilityAmt',
    ];

    public function MonthlyReading(){
    	 return $this->belongsTo('App\MonthlyReading','readingID');
    }

    public function Contract(){
    	return $this->belongsTo('App\Contract','stallMeterID', 'contractID');
    }

    public function Billing(){
        return $this->belongsToMany('App\Billing_Details','tblbilling_utilities','stallMeterID','billDetID');
    }   
}
