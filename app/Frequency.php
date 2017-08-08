<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frequency extends Model
{
    //
    protected $table = "tblFrequency";
    protected $primaryKey = "frequencyID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    public function StallRate(){
    	return $this->hasMany('App\StallRate', 'frequencyID');
    }
}
