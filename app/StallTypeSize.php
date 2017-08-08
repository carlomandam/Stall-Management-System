<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StallTypeSize extends Model
{
    // use SoftDeletes;
    
    protected $table = "tblStallType_Size";
    protected $primaryKey = "stypeSizeID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    public function STypeSize(){
        return $this->belongsToMany('App\StallType','tblStallType_StallSize','stypeSizeID','stypeID');
    }
}
