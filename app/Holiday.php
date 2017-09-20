<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
	use SoftDeletes;
    
    protected $table = "tblHoliday";
    protected $primaryKey = "ID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'Name',
        'Date',
    ];
}
