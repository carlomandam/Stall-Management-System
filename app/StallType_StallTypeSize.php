<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StallType_StallTypeSize extends Model
{
    use SoftDeletes;
    
    protected $table = "tblstalltype_stallsize";
    protected $primaryKey = "stype_sizeID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    
    public function Utility(){
        return $this->belongsTo('App\StallType','stypeID');
    }
    
    public function Stall(){
        return $this->belongsTo('App\StallTypeSize','stypeSizeID');
    }
}
