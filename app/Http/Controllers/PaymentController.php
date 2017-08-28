<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRental;
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
 }
