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
    		$transaction = "";
            $today = Carbon::today();
        
    		//FOR DAILY RATES//
             $activeContracts = DB::table('tblContractInfo as a')
            ->join('tblStallRental_Info as b','b.stallRentalID','a.stallRentalID')
            ->join('tblStallRate as c','c.stallRateID','a.stallRateID')
            ->join('tblStallRate_Details as d','d.stallRateID','c.stallRateID')
            ->where('a.contractStart','<=',$today->format('Y-m-d'))
            ->get();
           
           
            
    		if(count($activeContracts) > 0)
    		{

    			foreach($activeContracts as $activeContracts)
    			{
    			$checkBill = Billing::where('stallRentalID','=',$active->stallRentalID)
    						->select('billDateFrom','billDateTo')
                            ->where('deleted_at','!=',NULL)
    						->orderBy('billDateTo','desc')->first();

    			if(count($checkBill) == 0) //if no records on billing pero start na ng rent//
    			{	
    				$getMonday = Carbon::today()->startOfWeek();
                    $last = Carbon::parse($getMonday)->addDays(6);

                    $start = date('Y-m-d',strtotime($active->contractStart));
                    $getContractMonday = Carbon::parse($start)->startOfWeek();
                    $nextBillFrom = Carbon::parse($getContractMonday)->addDays(6);
                    

                  
    				while(date('Y-m-d',strtotime($last)) >= date('Y-m-d',strtotime($nextBillFrom))) 
    					{
                            
                            
                                try
                                {
                                    DB::beginTransaction();

            						$bill = Billing::create([
            							'billDateFrom' => $start,
            							'billDateTo' => $nextBillFrom,
            							'stallRentalID' => $active->stallRentalID
            						]);
        	    				   
                                    DB::commit();}

                                    catch(\Illuminate\Database\QueryException $e){
                                        DB::rollback();}

                              $start = Carbon::parse($bill->billDateTo)->addDays(1);
                              $nextBillFrom = Carbon::parse($bill->billDateTo)->addDays(7);
                          

    					}
    			}

    		  
          

    			if(date('Y-m-d',strtotime($today)) > date('Y-m-d',strtotime($checkBill->billDateTo)))
                {	
                        $lastBillDateTo = date('Y-m-d',strtotime($checkBill->billDateTo));

                        $start = Carbon::parse($lastBillDateTo)->addDays(1);

                        $last = Carbon::parse($lastBillDateTo)->addDays(7);
                    
                            
        					while(date('Y-m-d',strtotime($today)) >= date('Y-m-d',strtotime($last))) 
        					{  

                                try{

                                DB::beginTransaction();
    	    					$newBill = Billing::create([
                                    'billDateFrom' => $start,
                                    'billDateTo' => $last,
                                    'stallRentalID' => $active->stallRentalID
                                    ]);
                                DB::commit();

                                $start = Carbon::parse($newBill->billDateTo)->addDays(1);
                                $last = Carbon::parse($newBill->billDateTo)->addDays(7);

                                 }
                                catch(\Illuminate\Database\QueryException $e){
        	    					DB::rollback();
                                }

        					}

         				
        		}
        			

    		}
    		

    	}
    		
    	//	end of checkBillRecords

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
