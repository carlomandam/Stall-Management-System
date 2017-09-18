<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRental;
use App\Billing;
use DB;

class BillingController extends Controller
{
    //
    public function index(){
          $stalls = StallRental::with('Contract','Stall','StallHolder')->get();
          // return ($stalls);

          // $stall
    	return view('transaction/PaymentAndCollection/Billing.index',compact('stalls'));
    }
    public function viewBill($id){
      $storeID = $id;
		return view('transaction/PaymentAndCollection/Billing.billList',compact('storeID'));    	
    }
     public function bill(){
		return view('transaction/PaymentAndCollection/Billing.bill');    	
    }
    public function createBill($id){
      // check last ID in tblBilling
      $storeID = $id;
      $billLastID = Billing::find(DB::table('tblBilling')->max('billID'))->pluck('billID');
      
      if(count($billLastID) == 0)
      {
        $billLastID = 1;
      }
      else{
          $billLastID = $billLastID[0]+1;
      }
      $billID = 'BILL'.str_pad($billLastID, 5, '0', STR_PAD_LEFT);

      //get business Info and Tenant's Name

      $stallRental = StallRental::with('StallHolder')->where('stallID',$storeID)->first();

         return view('transaction/PaymentAndCollection/Billing.createBill',compact('billID','storeID','stallRental'));
      
    }
}
