<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RequestT extends Model
{
    //
    use SoftDeletes;
    
    protected $table = "tblRequest";
    protected $primaryKey = "requestID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'requestType',
    	'requestText',
    	'status',
    	'remarks',
    	'submitDate',
    	'approvedDate',
    ];

    public function RequestInfo(){
    	return $this -> hasOne('App\RequestInfo','requestID');
    }
    public function Rental(){
        return $this ->belongsTo('App\StallRental', 'stallRentalID' );
    }

}
