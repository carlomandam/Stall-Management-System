<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $table = "tblrent_info";
    protected $primaryKey = "rentID";

    public function Stall()
    {
    	return $this->hasMany('App\Stall','stallID');
    }

     public function Vendor()
    {
    	return $this->hasMany('App\Vendor','venID');
    }
    public function Contract(){
        return $this->belongsTo('App\Contract','rentID');
    }
}
