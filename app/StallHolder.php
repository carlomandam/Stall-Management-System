<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StallHolder extends Model
{
    use SoftDeletes;
    protected $table = "tblStallHolder";
    protected $primaryKey = "stallHID";
    protected $softDelete = true;
    public function Stall(){
        return $this->belongsToMany('App\Stall', 'tblstallrental_info', 'stallHID', 'stallID')->withPivot('stallRentalID')->orderBy('stallHLName','ASC');
    }
    
    public function Contract()
    {
        return $this->hasMany('App\Contract','stallHID');
    }
    
    public function ActiveContracts()
    {
        return $this->hasMany('App\Contract','stallHID')->whereNotNull('contractStart')->whereNotNull('contractEnd')->where('contractEnd','>=',date("Y-m-d"))->where('contractStart','<=',date("Y-m-d"));
    }
    
    public function ContactNo()
    {
        return $this->hasMany('App\ContactNo','stallHID');
    }

    public function Requirement(){
        return $this->belongsToMany('App\Requirements','tblStallHolder_Req','stallHID','reqID');
    }
}