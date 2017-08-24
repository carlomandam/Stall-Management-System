<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $table = "tblstallrental_info";
    protected $primaryKey = "stallRentalID";

    public function Contract(){
        return $this->has('App\Contract','stallRentalID');
    }
}
