<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CollectionDetails extends Model
{
     use SoftDeletes;

    protected $table = "tblCollection_Details";
    protected $primaryKey = "collectionDetID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'collectionID',
    	'collectDate'
    
    ];

    public function PaymentCollection()
    {
    	return $this->belongsTo('App\Payment','tblPayment_Collection','collectionDetID','paymentID');
    }
}
