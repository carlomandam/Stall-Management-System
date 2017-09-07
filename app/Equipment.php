<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SoftDeletes;

class Equipment extends Model
{
    //
     
    
    protected $table = "tblEquipment";
    protected $primaryKey = "equipmentID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    public $timestamps =false;
    protected $fillable = [
    	'equipmentName',
    	'rentDailyRate',
    	'equipStallLimit',
    
    ];
}
