<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penalty extends Model
{
    use SoftDeletes;
    
    protected $table = "tblPenalty";
    protected $primaryKey = "penID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    
    public function Bill(){
        return $this->belongsToMany('App\Bill','penID');
    }
    
    public function Fee(){
        return $this->belongsTo('App\Fee','feeID');
    }
}
