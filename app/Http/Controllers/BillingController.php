<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRental;
use App\Billing;
use App\BillDates;
use Carbon\Carbon;
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
      // get selected Stall Code
      $storeID = $id; 
      // 

      // billing header
      $billLastID = Billing::whereRaw('billID = (select max(`billID`) from tblBilling)')
      ->first();  
      $billLastID= count($billLastID) == 0 ? 1 : $billLastID->billID +1;
      $billID = 'BILL'.str_pad($billLastID, 5, '0', STR_PAD_LEFT);
      $stallRental = StallRental::with('StallHolder','Contract')->where('stallID',$storeID)
      ->first();
      // 

      // Rental fee
      $checkBillID = Billing::where('contractID',$stallRental->Contract->contractID)
      ->orderBy('created_at','desc')
      ->pluck('billID')
      ->first();

      $lastBill = BillDates::where('billID',$checkBillID)
      ->pluck('billDate')
      ->first();

    
      $getMarketDays = DB::table('tblUtilities as a')
            ->where('utilitiesID','util_market_days') 
            ->select('utilitiesDesc')
            ->get();

       $marketDays = []; 
            //dayOfWeek returns integer 0 if Sunday, and so on...

            // store yung marketDays as array
            foreach($getMarketDays as $getDays)
            {   

                $marketDays = explode(",",$getDays->utilitiesDesc);
            
            }

            for($ctr = 0; $ctr < count($marketDays); $ctr++)
            {

                if($marketDays[$ctr] == "sun")
                {
                  $marketDays[$ctr] = 0;
                }
                else if($marketDays[$ctr] == "mon")
                {
                  $marketDays[$ctr] = 1;
                }
                else if($marketDays[$ctr] == "tue")
                {
                  $marketDays[$ctr] = 2;
                }
                else if($marketDays[$ctr] == "wed")
                {
                  $marketDays[$ctr] = 3;
                }
                else if($marketDays[$ctr] == "thur")
                {
                  $marketDays[$ctr] = 4;
                }
                else if($marketDays[$ctr] == "fri")
                {
                  $marketDays[$ctr] = 5;
                }
                else if($marketDays[$ctr] == "sat")
                {
                  $marketDays[$ctr] = 6;
                }
                else
                {
                  $marketDays[$ctr] = 7;
                }

            }
      $newBill = count($lastBill) == 0 ? Carbon::today() : Carbon::parse($lastBill);
      
      
        if(in_array($newBill->dayOfWeek, $marketDays))
        {
          $newBill = $newBill->format('Y-m-d');
        }
        else
        {
          for ($i=0; $i<count($marketDays); $i++) { 
            if($marketDays[$i] > $newBill->dayOfWeek)
            {
              $diff = ($marketDays[$i] - $newBill->dayOfWeek);

              break;
            }
          }

         
        }
        return view('transaction/PaymentAndCollection/Billing.createBill',compact('billID','storeID','stallRental','newBill'));
      
      
      
    }

    
}
