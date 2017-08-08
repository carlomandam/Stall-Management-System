<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StallTypeStallSize extends Model
{
    //
    protected $table = "tblstallType_stallSize";
    protected $primaryKey = "stype_SizedID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    public function StallType(){
    	return $this->hasMany('App\StallTypeSize', 'stype_SizedID');
    }

    
}
