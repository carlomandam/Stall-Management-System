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
    
    public function StallRental()
    {
        return $this->hasMany('App\StallRental','stallHID');
    }
    
    public function ActiveStallRental()
    {
        return $this->hasMany('App\StallRental','stallHID')->where('stallRentalStatus','1');
    }
    
    public function ContactNo()
    {
        return $this->hasMany('App\ContactNo','stallHID');
    }
}