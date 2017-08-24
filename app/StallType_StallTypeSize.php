<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class StallType_StallTypeSize extends Model
{
    //use SoftDeletes;
    
    protected $table = "tblstalltype_stallsize";
    protected $primaryKey = "stype_sizeID";
    //protected $softDelete = true;
    //protected $dates = ['deleted_at'];
    
    public function StallRate(){
        return $this->hasOne('App\StallRate','stype_SizeID','stype_SizeID')->where('stallRateEffectivity','<=',date('y-m-d'))->orderBy('stallRateEffectivity','DESC');
    }
    
    public function StallType(){
        return $this->belongsTo('App\StallType','stypeID','stypeID');
    }
    
    public function StallTypeSize(){
        return $this->belongsTo('App\StallTypeSize','stypeSizeID','stypeSizeID');
    }
    
    public function Stall(){
        return $this->hasMany('App\Stall','stype_SizeID');
    }
}
