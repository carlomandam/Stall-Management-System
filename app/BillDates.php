<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BillDates extends Model
{
    //
      use SoftDeletes;
    
    protected $table = "tblBill_Dates";
    protected $primaryKey = "billDatesID";
    protected $softDelete = true;
    protected $dates = ['deleted_at','billDate'];
    protected $fillable = [
    	'billID',
    	'billDate',
    	'isVoid'
    ];
    
    public function Billing(){
        return $this->belongsTo('App\Billing','billID');
    }
}
