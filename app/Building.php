<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building extends Model
{
    use SoftDeletes;
    
    protected $table = "tblBuilding";
    protected $primaryKey = "bldgID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'bldgName',
    	'bldgCode',
    	'bldgDesc',
    		
    ];
    
    public function Floor(){
        return $this->hasMany('App\Floor','bldgID');
    }
}
