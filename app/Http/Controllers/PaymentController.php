<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRental;
use App\Contract;
use App\Billing;
use App\Payment;
use App\StallHolder;
use App\StallRate;
use DateTime;
use PDF;
use PDFF;
use DB;
use DateTimeZone;
use Carbon\Carbon;
class PaymentController extends Controller
{
    	public function index()
    	{
    	

    		return view('transaction/PaymentAndCollection/finalPayment');

    
    	}

    	public function createBill()
    	{
    		return view('transaction/PaymentAndCollection/createBill');
    	}

    	function checkRecords()
    	{
            $today = Carbon::today();
             $activeContracts = DB::table('tblContractInfo as a')
            ->where('a.contractStart','>=',$today->format('Y-m-d'))
            ->select('a.collectionType','a.contractID')
            ->get();
           
           foreach($activeContracts as $active)
           {
                if($active->collectionType == 1) //daily collection
                {
                  
                    return $this->dailyBilling($active->contractID);
                }
           }	
    	}

        function dailyBilling($dailyBill)
        {
            $getRate = DB::table('tblContractInfo as a')
            ->rightJoin('tblstallrate as b','a.stallRateID','=','b.stallRateID')
            ->where('a.contractID',$dailyBill)
            ->select('b.dblRate','b.dblPeakRate','b.peakRateType') 
            ->get();

            //1 if fixed, 2 if percent in peakRateType
            // check if nagmatch sa market days yung day today
            // temporarily, sinet ko na 1 utilitiesID para sa marketDays at 
            // 2 para sa PeakDays

             $getPeakDays = DB::table('tblUtilities as a')
            ->where('utilitiesID','2') 
            ->select('utilitiesDesc')
            ->get();

            $getMarketDays = DB::table('tblUtilities as a')
            ->where('utilitiesID','1') 
            ->select('utilitiesDesc')
            ->get();

            $counter = 0;
            $dayOfWeek = Carbon::today()->dayOfWeek;
            $marketDays = []; 
            //dayOfWeek returns integer 0 if Sunday, and so on...

            // store yung marketDays as array
            foreach($getMarketDays as $getDays)
            {   
                $marketDays = explode(",",$getDays->utilitiesDesc);
            }

            // check if $dayOfWeek == $marketDays[index] then 
            // check if nasa Peakrate bago iinsert sa tblBilling 
            // sorry, iwan muna kita :( 

            // Coleen, beginTransaction gamitin mo!!!
            /*
            $store = [];

            return Carbon::today()->dayOfWeek ." ". $marketDays[0];
            for($x = 0; $x<count($marketDays); $x++) 
            {

                if($marketDays[$x] == 1)
                {
                    $store[$x] = "Mon";
                }
                else if($marketDays[$x] == 2)
                {
                    $store[$x] = "Tues";
                }
                else if($marketDays[$x] == 3)
                {
                    $store[$x] = "Wed";
                }
                else if($marketDays[$x] == 4)
                {
                    $store[$x] = "Thurs";
                }
                else if($marketDays[$x] == 5)
                {
                    $store[$x] = "Fri";
                }
                else if($marketDays[$x] == 6)
                {
                    $store[$x] = "Sat";
                }
                else
                {
                     $store[$x] = "Sun";
                }


            }
            */ 

        }

    	public function getBills()
    	{
    			$data = DB::select('Select a.stallRentalID as stallRentalID, CONCAT_WS(" ",b.stallHFName, b.stallHMName, b.stallHLName) as stallHolderName, a.billID as billNo,a.billDateFrom as billFrom, a.billDateTo as billTo, date(a.created_at) as billDate, c.stallID as StallID, h.dblRate as rate from tblbilling_info a left JOIN tblstallrental_info c on(c.stallRentalID = a.stallRentalID) left JOIN  tblstallholder b on b.stallHID = c.stallHID LEFT JOIN  tblcontractinfo f on f.stallRentalID = c.stallRentalID LEFT JOIN tblstallrate g on g.stallRateID = f.stallRateID LEFT JOIN tblstallrate_details h on h.stallRateID = f.stallRateID');
    			return response()->json($data);
    	}

        public function getPaymentStatus(){
            $payments = Payment::all();

            $bills = Billing::with('Payment')
                    ->whereNotIn('billID',$payments)->pluck('stallRentalID');

            $contractRate = Contract::where('stallRentalID','=',$bills)->get();

            
          //  return response()->json($contractRate);

        }

    	public function generateBill($id)
    	{
            $billID = 'BILL'.str_pad($id, 5, '0', STR_PAD_LEFT); 
    		$billing = Billing::where('billID','=',$id)->first();
    		$contract = Contract::where('stallRentalID','=',$billing->stallRentalID)->get();

            $pdf = PDF::loadview('transaction.PaymentAndCollection.bill',compact('billing','contract','billID'))->setPaper([0,0,612,396]);

    		return $pdf->stream('bill.pdf');
     //   return view('transaction.PaymentAndCollection.bill',compact('billID','billing','contract'));
            
          
    	}


 }
