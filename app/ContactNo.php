<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactNo extends Model
{
    protected $table = "tblContactNos";
    protected $primaryKey = "contactID";

    public function StallRental()
    {
    	return $this->belongsToMany('App\StallRental');
    }

}
