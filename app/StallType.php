<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StallType extends Model
{
    use SoftDeletes;
    
    protected $table = "tblStallType";
    protected $primaryKey = "stypeID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    
    public function STypeSize(){
        return $this->belongsToMany('App\StallTypeSize','tblStallType_StallSize','stypeID','stypeSizeID');
    }
    
    public function Stall(){
        return $this->hasMany('App\Stall','stypeID');
    }
    
    public function StallRate(){
        return $this->hasMany('App\StallRate','stypeID');
    }
}
