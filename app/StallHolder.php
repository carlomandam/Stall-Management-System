<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class StallHolder extends Model
{
    
    protected $table = "tblStallHolder";
    protected $primaryKey = "stallHID";
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