<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StallRental extends Model
{
    protected $table = "tblStallRental_Info";
    protected $primaryKey = "stallRentalID";
    protected $fillable = [
        'stallHID',
        'stallID',
        'startingDate'
    ];

     public function Assoc()
    {
        return $this->belongsToMany('App\StallHolder','tblStallRental_StallHAssoc','stallRentalID','stallH_assocID');
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

        return $this->hasOne('App\Contract','stallRentalID');

    }
    
    public function Product(){
        return $this->belongsToMany('App\Product','tblstallrental_product','stallRentalID','productID');
    }

    public function Billing()
    {
        return $this->hasMany('App\Billing','stallRentalID');
    }
    
}
