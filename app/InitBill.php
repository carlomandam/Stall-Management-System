<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InitBill extends Model
{
    use SoftDeletes;

    protected $table = "tblBill_Initialfee";
    protected $increments = false;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'billID',
        'initialFeeID',
    ];
    
    public function Billing()
    {
        return $this->belongsTo('App\Billing','billID');
    }
}
