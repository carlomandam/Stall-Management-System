<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collections extends Model
{
     protected $table = "tblCollection_Info";
    protected $primaryKey = "collectionID";

    public function ContractLength(){
        return $this->belongsTo('App\ContractLength','contractLengthID');
    }

    public function StallRental(){
        return $this->belongsTo('App\StallRental','stallRentID');
    }
}
