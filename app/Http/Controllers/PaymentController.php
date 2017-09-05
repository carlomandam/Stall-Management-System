<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRental;
use App\Contract;
use App\Billing;
use App\Payment;
use App\StallHolder;
use App\StallRate;
use DB;
use Carbon\Carbon;
class PaymentController extends Controller
{
    	public function index()
    	{
    	

    		return view('transaction/PaymentAndCollection/paymentAndCollection');

    
    	}

    	public function createBill()
    	{
    		return view('transaction/PaymentAndCollection/createBill');
    	}

    	function checkRecords()
    	{
    		$transaction = "";
    		//validate first if contract is not yet expiring next week before insert
    		$activeContracts = Contract::with('StallRate')->where('contractStart','<=',Carbon::today())->get();

    		if(count($activeContracts) > 0)
    		{
    			foreach($activeContracts as $active)
    			{
    			$checkBill = Billing::where('stallRentalID','=',$active['stallRentalID'])
    						->select('billDateFrom','billDateTo')
    						->orderBy('billDateTo','desc')->first();

    			if(count($checkBill) == 0) //if no records on billing pero start na ng rent//
    			{	
    				$today = Carbon::now();
    				$getMonday = $today->startOfWeek();
    				$last = $getMonday->addDays(6);
    				while(date('Y-m-d',strtotime($today)) >= date('Y-m-d',strtotime($last))) 
    					{
    						$start = date('Y-m-d',strtotime($active->contractStart));
    						$last = date('Y-m-d',strtotime($last));
    						$bill = Billing::create([
    							'billDateFrom' => $start,
    							'billDateTo' => $last,
    							'stallRentalID' => $active->stallRentalID
    						]);
	    				
	    					$last = $bill->billDateTo;
	    					$start = $bill->billDateFrom->addDay(1);

    					}
    			}

    			if(Carbon::today() >=  $checkBill['billDateFrom'] && Carbon::today() <= $checkBill['billDateTo'])
    			{
    				$transaction = "done"; //may bill na for today
    			}

    			if(Carbon::today() > $checkBill['billDateTo'])

    			{		$last = $checkBill['billDateTo'];
    					//check muna kung may record na ba na nag-eexist sa billing
    					while(Carbon::today() > $last) 
    					{
	    					$newBill = new Billing;
	    					//getfirstfrequencyofrates//
	    					$newBill->billDateFrom = $checkBill['billDateFrom'];//addOneDay
	    					$newBill->billDateTo = $checkBill['billDateTo'];//addSevenDays
	    					$newBill->stallRentalID = $active['stallRentalID'];
	    					$newBill->save();	

	    					$last = $newBill['billDateTo'];
    					}


     				
    			}
    			 if(Carbon::today() < $checkBill['billDateTo'])
    			{
    				
    				$deleteRecords = Billing::where('stallRentalID','=',$checkBill['stallRentalID'])
    				->where('billDateFrom','>', Carbon::today())
    				->orderBy('billDateTo','desc')
    				->get();

    				foreach($deleteRecords as $del)
    				{
    					$del->delete();
    				}
    			}

    			}
    		

    		}
    		
    	//	return json_encode($transaction);

    	}

    	public function getBills()
    	{
    			$data = DB::select('Select a.stallRentalID as stallRentalID, CONCAT_WS(" ",b.stallHFName, b.stallHMName, b.stallHLName) as stallHolderName, a.billID as billNo,a.billDateFrom as billFrom, a.billDateTo as billTo, date(a.created_at) as billDate from tblbilling_info a left JOIN tblstallrental_info c on(c.stallRentalID = a.stallRentalID) left JOIN  tblstallholder b on b.stallHID = c.stallHID');
    			return response()->json($data);
    	}

        public function getPaymentStatus(){
            $payments = Payment::all();

            $bills = Billing::with('Payment')
                    ->whereNotIn('billID',$payments)->pluck('stallRentalID');

            $contractRate = Contract::where('stallRentalID','=',$bills)->get();

          /* foreach($contractRate->StallRate->RateDetail as $con)
            {
                $balance += $con->dblRate;
            }*/

          //  $stallHolders = StallRental::with('Stall','StallHolder')->whereIn('stallRentalID',$bills->stallRentalID);
            return response()->json($contractRate);
        }

    	public function generateBill($id)
    	{
    		$billing = Billing::where('billID','=',$id)->first();
    		$contract = Contract::where('stallRentalID','=',$billing->stallRentalID)->get();
    		return view('transaction/PaymentAndCollection/bill',compact('billing','contract'));
    	}


 }
