<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipStocks extends Model
{
    //
    protected $table = "tblEquipment_Stock";
    protected $primaryKey = "equipmentStockID";
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    public $timestamps =false;
    protected $fillable = [
    	'equipmentID',
    	'stockStatus',
    	'stockQty',
    
    ];

    public function Equipment(){
    	return $this->belongsTo('App/Equipment','equipmentID');
    }

}
