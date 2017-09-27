<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Initial_Details extends Model
{
    //
	   use SoftDeletes;
    protected $table = "tblInitial_Details";
    protected $primaryKey = "initDetID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'initID',
        'paymentID',
        'contractID',
    ];
    
    public function InitialFee(){
        return $this->belongsTo('App\InitialFee','initID');
    }
     public function Contract(){
        return $this->belongsTo('App\Contract','contractID');
    }
     public function Payment(){
        return $this->belongsTo('App\Payment','paymentID');
    }
}
