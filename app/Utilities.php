<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilities extends Model
{
    //
     protected $table = "tblUtilities";
    protected $primaryKey = "utilitiesID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'utilitiesDesc'
    ];
}
