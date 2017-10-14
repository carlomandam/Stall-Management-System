<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities;
use App\InitialFee;
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
    $oldSecurity  = InitialFee::where('initDesc', 'Security Deposit')
                                  ->orderBy('initID', 'desc')
                                  ->skip(1)
                                  ->take(1)
                                  ->get();
    $newSecurity  = InitialFee::where('initDesc', 'Security Deposit')
                                  ->orderBy('initID', 'desc')
                                  ->get();
    $oldMain  = InitialFee::where('initDesc', 'Maintenance Fee')
                                  ->orderBy('initID', 'desc')
                                  ->skip(1)
                                  ->take(1)
                                  ->get();
    $newMain  = InitialFee::where('initDesc', 'Maintenance Fee')
                                  ->orderBy('initID', 'desc')
                                  ->get();                        
     // return ($oldMain);
    return view('Utilities.InitialFee.index',compact('oldSecurity', 'newSecurity','oldMain','newMain'));
  }
  public function initialFeeUpdate(Request $request){
     $rules = [
            'Amount' => 'required|',
            'Date' => 'required'
        ];
        $messages = [
            
            'required' => 'The :attribute field is required.'
           ,
        ];
        $niceNames = [
            'Amount' => 'Amount',
            'Date' => 'Effectivity Date'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
         if ($validator->passes()) {

              $util  = new InitialFee;
              $util->initDesc = $request->Desc;
              $util->initAmt = $request->Amount;
              $util->initEffectiveDate = $request->Date;

              $util->save();
        
            return response()->json(['success'=>'Added new records.']);
        }
        else{
            
             return response()->json(['error'=>$validator->errors()->all()]);
        }

  }
  public function collectionStatusIndex(){
    $utils  = Utilities::where('utilitiesID', "util_collection_status")
                        ->select('collect','reminder','warning','lock','terminate')
                        ->get();
    // return($utils);
    return view('Utilities.CollectionStatus.index',compact('utils'));
  }
  public function collectionStatusUpdate(Request $request, $id){
      $util  = Utilities::find($id);
      if(count($util) == 0){
        $util = new Utilities();
        $util->utilitiesID = $id;
      }
      $util->collect = $request->name_collect;
      $util->reminder = $request->name_reminder;
      $util->warning = $request->name_warning;
      $util->lock = $request->name_lock;
      $util->terminate = $request->name_terminate;
      $util->save();
      return response()->json(['success'=>'Update new records.']);
  } 		
}
