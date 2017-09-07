<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InitFee extends Model
{
    use SoftDeletes;

    protected $table = "tblUtilities_Initial";
    protected $primaryKey = "initialFeeID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'billID',
        'initialFeeID',
    ];
    
    public function Billing()
    {
        return $this->belongsToMany('App\Billing','tblbill_initialfee','initialFeeID','billID');
    }
}
