<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    	public function paymentIndex()
    	{
    		return view('transaction/PaymentAndCollection/Payment_Module');
    	}
 }
