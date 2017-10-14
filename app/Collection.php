<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Collection extends Model
{
    //

    use SoftDeletes;

    protected $table = "tblCollection";
    protected $primaryKey = "collectionID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'contractID'
    
    ];
    
    public function Contract(){
        return $this->belongsTo('App\Contract','contractID');
    }

    public function CollectionDetails(){
        return $this->hasMany('App\CollectionDetails','collectionID');
    }

    public function TodayDet(){
        return $this->hasOne('App\CollectionDetails','collectionID')->where('collectDate',date("Y-m-d"));
    }
}
