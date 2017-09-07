<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StallRate extends Model
{
    use SoftDeletes;
    
    protected $table = "tblStallRate";
    protected $primaryKey = "stallRateID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = ['dblRate'
    ];
    
    public function typeSize(){
        return $this->belongsTo('App\StallType_StallTypeSize','stype_SizeID','stype_SizeID');
    }
    
    public function Contract(){
        return $this->hasMany('App\Contract','stallRateID');
    }
}