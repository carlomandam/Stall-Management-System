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
  	$utils  = Utilities::where('utilitiesID', "util_market_days")
                        ->select('utilitiesDesc')
  						          ->get();
  	// return($utils->utilitiesDesc);
  	return view('Utilities.MarketDays.index',compact('utils'));
  }
  public function marketDaysUpdate(Request $request, $id){
  		//return $request->days;
      $util  = Utilities::find($id);
      if(count($util) == 0){
        $util = new Utilities();
        $util->utilitiesID = $id;
      }
  		$util->utilitiesDesc = $request->days;
  		$util->save();
  		return response()->json(['success'=>'Update new records.']);
  }
  public function peakRatesIndex(){
    $utils  = Utilities::where('utilitiesID', 2)
                        ->select('peakType','peakQuan')
                        ->get();
    return view('Utilities.PeakRates.index',compact('utils'));
  }
  public function peakRatesUpdate(Request $request, $id){
      $util  = Utilities::findOrFail($id);

      $util->peakType = $request->peakType;
      $util->peakQuan = $request->rate;
      $util->save();
      return response()->json(['success'=>'Update new records.']);
  }		
}
