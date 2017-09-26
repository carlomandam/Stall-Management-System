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
        'billStatus',
        'contractID'
    ];
    
    public function BillPayment()
    {
    return $this->belongsToMany('App\BillPayment','tblBill_Initial','billID','billPaymentID');
    }

    public function Contract()
    {
    return $this->belongsTo('App\Contract','contractID');
    }

    public function Initial()
    {
    return $this->hasMany('App\initBill','billID');

    
    public function Charges()
    {
        return $this->belongsToMany('App\Charges','tblBill_Charges','billID','chargeID');
    }
    public function MonthlyReading()
    {
        return $this->belongsToMany('App\MonthlyReading','tblBill_Reading','billID','readingID');
    }
     public function InitialFee()
    {
        return $this->belongsToMany('App\InitialFee','tblBill_Initial','billID','billInitialID');
    }
    public function BillDates()
    {
        return $this->hasMany('App\BillDates','billID');

    }
}
