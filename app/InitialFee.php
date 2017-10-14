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
    
   public function Initial_Details(){
        return $this->hasMany('App\Initial_Details','initID');
    }
}
