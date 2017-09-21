<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InitialFee extends Model
{
    //
     use SoftDeletes;
    
    protected $table = "tblBill_Initial";
    protected $primaryKey = "billInitialID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'billID',
        'initialAmt',
        'initialType'
    ];
    
    public function Billing(){
        return $this->belongsToMany('App\Billing','tblBill_Initial','billInitialID','billID');
    }
}
