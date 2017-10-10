<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestInfo extends Model
{
    //
     use SoftDeletes;
    
    protected $table = "tblRequestInfo";
    protected $primaryKey = "reqInfoID";
    protected $softDelete = true;
    public $timestamps = false;
    protected $fillable = [
        'requestID',
    	'stallRequested',
        'contractID',
    	
    
    ];

    public function Request(){
    	return $this -> belongsTo('App\Request','requestID');
    }
}
