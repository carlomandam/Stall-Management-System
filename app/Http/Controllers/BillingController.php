<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRental;

class BillingController extends Controller
{
    //
    public function index(){
          $stalls = StallRental::with('Contract','Stall','StallHolder')->get();
          // return ($stalls);
    	return view('transaction/PaymentAndCollection/Billing.index',compact('stalls'));
    }
    public function viewBill($id){
        
		return view('transaction/PaymentAndCollection/Billing.billList');    	
    }
     public function bill(){
		return view('transaction/PaymentAndCollection/Billing.bill');    	
    }
    public function createBill(){
      return view('transaction/PaymentAndCollection/Billing.createBill');
    }
}
