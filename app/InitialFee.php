<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InitialFee extends Model
{
    //
     use SoftDeletes;
    
    protected $table = "tblInitialFees";
    protected $primaryKey = "initID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'initAmt',
        'initDesc',
        'initEffectiveDate',
    ];
    
    public function InitFeeDetail(){
        return $this->hasMany('App\InitFeeDetail','initID');
    }
}
