<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Payment_Collection extends Model
{
	use Softdeletes;
    protected $table = "tblPayment_Collection";
    protected $primaryKey = "paymentID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'paymentDate',
    	'paidAmt'
    
    ];
    


}
