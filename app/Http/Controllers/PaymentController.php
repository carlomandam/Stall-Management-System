<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRental;
use App\Contract;
use App\Billing;
use App\Payment;
use Carbon\Carbon;
class PaymentController extends Controller
{
    	public function index()
    	{

    		return view('transaction/PaymentAndCollection/tablePayment');

    		//return $data;
    	}

    	public function createBill()
    	{
    		return view('transaction/PaymentAndCollection/createBill');
    	}

    	function checkRecords()
    	{
    		$activeContracts = Contract::with('StallRate')->where('contractStart','<=',Carbon::now())
    							->select('contractID','stallRentalID','stallRateID')
    							->get();
    		if(count($activeContracts) > 0)
    		{
    			foreach($activeContracts as $active)
    			{

    			$checkBill = Billing::where('stallRentalID','=',$active['stallRentalID'])
    						->select('billDateFrom','billDateTo')->get();
    			}

    		}
    	

    		return json_encode($activeContracts);

    	}
 }
