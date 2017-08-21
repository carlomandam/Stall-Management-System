<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StallHolder extends Model
{
    
    protected $table = "tblStallHolder";
    protected $primaryKey = "stallHID";

 	public function StallRental(){
 		return $this->belongsToMany('App\Stall', 'tblstallrental_info', 'stallHID', 'stallID')->withPivot('stallRentID')->orderBy('stallHLName','ASC');
 	}
}
