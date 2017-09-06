<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities;
use Response;
use Validator;
use Redirect;

class UtilitiesController extends Controller
{
  public function marketDaysIndex(){
  	$utils  = Utilities::where('utilitiesID', 1)
  						->get();
  	// return($utils->utilitiesDesc);
  	return view('Utilities.MarketDays.index',compact('utils'));
  }
  public function marketDaysUpdate(Request $request, $id){
  		$util  = Utilities::findOrFail($id);
  		// $temp = 'MarketDays(';
  		// $temp .= $request->days;
  		// $temp.=')';
  		$util->utilitiesDesc = $request->days;
  		$util->save();
  		return response()->json(['success'=>'Update new records.']);
  }		
}
