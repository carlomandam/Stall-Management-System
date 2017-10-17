<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Stall extends Model
{
    use SoftDeletes;
    
    protected $table = "tblStall";
    protected $primaryKey = "stallID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    public $incrementing = false;
    
    public function Pending(){
        return $this->hasMany('App\Contract','stallID','stallID')->whereNull('prevContractID')->whereNull('contractStart')->whereNull('contractEnd');
    }
    
    public function StallType(){
        return $this->belongsTo('App\StallType_StallTypeSize','stype_SizeID','stype_SizeID');
    }
    
    public function Floor(){
        return $this->belongsTo('App\Floor','floorID');
    }

    public function CurrentTennant(){
        return $this->hasOne('App\Contract','stallID')->where('contractStart','!=','NULL')->with('StallHolder');
    }
    
    public function StallUtility(){
        return $this->hasMany('App\StallUtility','stallID');
    }
    
    public function StallHolder(){
       return $this->belongsToMany('App\StallHolder', 'tblcontractinfo', 'stallID', 'stallHID')->orderBy('stallID','ASC');
    }
    
    public function Contract(){
        return $this->hasMany('App\Contract','stallID');
    }

    public function Submeter(){
        return $this->belongsToMany('App\Submeter', 'tblstall_utilities', 'stallID', 'stallUtilityID')->wherePivot('utilityType',"=","2");
    }

    public function Electricity(){
        return $this->belongsToMany('App\Submeter', 'tblstall_utilities', 'stallID', 'stallUtilityID')->wherePivot('utilityType',"=","1");
    }

    public function Water(){
        return $this->belongsToMany('App\Submeter', 'tblstall_utilities', 'stallID', 'stallUtilityID')->wherePivot('utilityType',"=","2");
    }
}