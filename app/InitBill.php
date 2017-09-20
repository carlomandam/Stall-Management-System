<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InitBill extends Model
{
    use SoftDeletes;

    protected $table = "tblBill_Initial";
    protected $primaryKey = "billInitialID";
    protected $increments = false;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'initialAmount',
        'initialType',
    ];
    
    public function bill()
    {
        return $this->belongsTo('App\Billing','billID');
    }
}
