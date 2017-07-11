<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StallRate extends Model
{
    use SoftDeletes;
    
    protected $table = "tblStallRate";
    protected $primaryKey = "srateID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    
    public function StallType(){
        return $this->belongsTo('App\StallType','stypeID');
    }
}