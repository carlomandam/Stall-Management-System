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
      $peak = Utilities::find('util_peak_days');
      if(count($peak) == 0){
        $peak = new Utilities();
        $peak->utilitiesID = 'util_peak_days';
      }
      $peak->utilitiesDesc = '';
      $peak->save();
  		$util->save();
  		return response()->json(['success'=>'Update new records.']);
  }
  public function peakDaysIndex(){
    $utils  = Utilities::where('utilitiesID', "util_market_days")
                        ->select('utilitiesDesc')
                        ->get();
   $peaks  = Utilities::where('utilitiesID', "util_peak_days")
                        ->select('utilitiesDesc')
                        ->get();                     
    return view('Utilities.PeakDays.index',compact('utils','peaks'));
  }
  public function peakDaysUpdate(Request $request, $id){
       $util  = Utilities::find($id);
      if(count($util) == 0){
        $util = new Utilities();
        $util->utilitiesID = $id;
      }
      $util->utilitiesDesc = $request->days;
      $util->save();
      return response()->json(['success'=>'Update new records.']);
  }
    public function initialFeeIndex(){
    $utils  = Utilities::where('utilitiesID', "util_initial_fee")
                        ->select('secAmount','mainAmount')
                        ->get();
  
    return view('Utilities.InitialFee.index',compact('utils'));
  }
  public function initialFeeUpdate(Request $request, $id){
      $util  = Utilities::find($id);
      if(count($util) == 0){
        $util = new Utilities();
        $util->utilitiesID = $id;
      }

      
      $util->secAmount= $request->sec_amount;
      $util->mainAmount = $request->main_amount;
   
      $util->save();
      return response()->json(['success'=>'Update new records.']);

  }
  public function collectionStatusIndex(){
    $utils  = Utilities::where('utilitiesID', "util_market_days")
                        ->select('utilitiesDesc')
                        ->get();
    // return($utils->utilitiesDesc);
    return view('Utilities.CollectionStatus.index');
  }
  public function collectionStatusUpdate(Request $request, $id){
     
  } 		
}
