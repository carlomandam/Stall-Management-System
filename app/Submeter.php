<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submeter extends Model
{
    //
      //
    protected $table = "tblSubMeter";
    protected $primaryKey = "subMeterID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'stallUtilityID',
    	'prevRead',
    	'presRead',
    	'readingFrom',
    	'readingTo',
    	
    ];
}
