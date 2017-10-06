<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
     use SoftDeletes;
    
    protected $table = "tblBilling";
    protected $primaryKey = "billID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'billDateFrom',
        'billDateTo',
        'billDueDate'
    ];
    
    public function Billing_Details(){
        return $this->hasMany('App\Billing_Details','billID');
    }
   


}
