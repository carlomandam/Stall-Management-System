<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyReading extends Model
{
    //
      use SoftDeletes;
    
    protected $table = "tblMonthlyReading";
    protected $primaryKey = "readingID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $dateFormat = 'Y-m-d';
    protected $fillable = [
        'prevReading',
        'presReading',
        'readingFrom',
        'readingTo',
        'totalBillAmount',
        'muiltplier',
        'utilType',
    ];

    public function Billing()
    {
    	return $this->belongsToMany('App\Billing','tblBill_Reading','readingID','billID');
    }

    public function UtilityMeterID(){
        return $this->hasMany('App\UtilityMeterID','readingID','stallMeterID');
    }
    
}
