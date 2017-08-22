<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StallRental extends Model
{
    protected $table = "tblStallRental_Info";
    protected $primaryKey = "stallRentID";
    protected $fillable = [
        'stallHID',
        'stallID',
        'startingDate'
    ];
    public function ContactNos()
    {
    	return $this->belongsToMany('App\ContactNo','tblStallRental_ContactNos','contactID','stallRentalID');
    }

     public function StallHolders()
    {
        return $this->belongsToMany('App\StallHolder','tblStallRental_StallHAssoc','stallRentID','stallH_assocID');
    }

    public function StallHolder()
    {
    	return $this->belongsTo('App\StallHolder','stallHID');
    }

    public function Stall()
    {
    	return $this->belongsTo('App\Stall','stallID');
    }
    
     public function Contract(){
        return $this->hasOne('App\Contract','stallRentID');
    }
    
}
