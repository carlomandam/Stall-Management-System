<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StallUtility extends Model
{
    use SoftDeletes;
    
    protected $table = "tblstall_utilities";
    protected $primaryKey = "stallUtilityID";


    public function Stall(){
        return $this->belongsTo('App\Stall','stallID');
    }

    public function Submeter(){
        return $this->hasMany('App\Submeter','stallUtilityID');
    }

    
}
