<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StallRateDetail extends Model
{
    use SoftDeletes;
    
    protected $table = "tblStallRate_Details";
    protected $primaryKey = "stallRateID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    
    public function StallRate(){
        return $this->belongsTo('App\StallRate','stallRateID');
    }
}
