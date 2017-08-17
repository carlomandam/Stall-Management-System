<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stall extends Model
{
    use SoftDeletes;
    
    protected $table = "tblStall";
    protected $primaryKey = "stallID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    public $incrementing = false;
    
    public function StallType(){
        return $this->belongsTo('App\StallType_StallTypeSize','stype_SizeID');
    }
    
    public function Floor(){
        return $this->belongsTo('App\Floor','floorID');
    }

    public function StallRental()
    {
        return $this->hasMany('App\StallRental','stallID');
    }

    
}
