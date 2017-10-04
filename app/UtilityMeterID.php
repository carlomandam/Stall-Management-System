<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UtilityMeterID extends Model
{
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

    public function MonhtlyReading(){
    	 return $this->belongsTo('App\MonhtlyReading','stallMeterID', 'readingID');
    }


    public function Contract(){
    	return $this->belongsTo('App\Contract','stallMeterID', 'contractID');
    }




   
}
