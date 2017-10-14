<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requirements extends Model
{
    use SoftDeletes;
    
    protected $table = "tblRequirements";
    protected $primaryKey = "reqID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'reqName',
    	'reqDesc',
    ];

    public function StallHolder(){
        return $this->belongsToMany('App\StallHolder','tblStallHolder_Req','reqID','stallHID')->withTimestamps();
    }
}
