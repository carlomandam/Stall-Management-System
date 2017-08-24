<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactNo extends Model
{
    protected $table = "tblContactNos";
    protected $primaryKey = "contactID";
    public $timestamps = false;
    
    public function StallHolder()
    {
    	return $this->belongsTo('App\StallHolder');
    }

}
