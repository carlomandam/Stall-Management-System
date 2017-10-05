<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use App\StallUtility;
use App\MonthlyReading;
use App\UtilityMeterID;
use App\SubMeter;
use Response;
use Validator;
use Redirect;

use DB;


class UtilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('transaction/PaymentAndCollection/Utilities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
      
                 // return($previos);       
        
      
                               
          // return($stalls);              
        return view('transaction/PaymentAndCollection/Utilities.create');
       
       
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        foreach ($request->subMeter as $meter) {
            $sub = new SubMeter([
              'stallUtilityID' => $meter['finalUtilID'],
              'prevRead' => $meter['finalSubPrev'],
              'presRead' => $meter['finalSubPres'],
              'readingFrom' => $meter['finalSubFrom'],
              'readingTo' => $meter['finalSubTo'] 
            ]);
            $sub->save();
        }
        return response()->json('Successfully added');

        // $rules = [
        //     'finalUtility' => 'required|',
        //     'finalDateFrom'=> 'required|before:finalDateTo',
        //     'finalDateTo'=> 'required|after:finalDateFrom|before_or_equal:today',
        //     'finalPrevious'=> 'required|',
        //     'finalPresent'=> 'required|',
        //     'finalBillAmount'=> 'required|numeric',
        //     'finalMulti'=> 'required|numeric|'
        // ];
        // $messages = [
            
        //     'required' => 'The :attribute field is required.',
        //     'before' => 'The :attribute field must be before the other date.',
        //     'before_or_equal' => 'The :attribute field must be before or after the other date',
        //     'after'=> 'The :attribute field must be after the other date',
        //     'numeric'=> 'The :attribute field must be numeric',
        //     'max'=> 'The :attribute field reach the maximum value'

        // ];
        // $niceNames = [
        //     'finalUtility' => 'Utility Type',
        //     'finalDateFrom' => 'Date From',
        //     'finalDateTo' => 'Date To',
        //     'finalPrevious'=>'Previous Reading',
        //     'finalPresent'=> 'Present Reading',
        //     'finalBillAmount' => 'Toatal Bill',
        //     'finalMulti' => 'Rate'
        // ];
        // $validator = Validator::make($request->all(),$rules,$messages);
        // $validator->setAttributeNames($niceNames); 
        // if($validator->passes()) {

        //     $monthlyReading = new MonthlyReading;
        //     $monthlyReading->prevReading = $request->finalPrevious;
        //     $monthlyReading->presReading = $request->finalPresent;
        //     $monthlyReading->readingFrom = $request->finalDateFrom;
        //     $monthlyReading->readingTo = $request->finalDateTo;
        //     $monthlyReading->totalBillAmount = $request->finalBillAmount;
        //     $monthlyReading->multiplier = $request->finalMulti;
        //     $monthlyReading->utilType = $request->finalUtility;

        //     // $contractMeter = new UtilityMeterID;
        //     $monthlyReading->save();
        //     return response()->json(['success'=>'Added new records.']);
        // }
        // else{
        //     return response()->json(['error'=>$validator->errors()->all()]);
        // }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
           $con = DB::table('tblContractInfo as contract')
                        ->join('tblStall as stall','contract.stallID','stall.stallID')
                        ->join('tblStall_Utilities as utility','stall.stallID','utility.stallID')
                        ->where('utility.utilityType','=', $id)
                        ->whereNotNull('contractStart')
                        ->orderBy('contract.contractID', 'desc')
                        ->get();

        $contractID = $con->pluck('contractID');
        $stalls = [];
        $stall=[];
        foreach ($contractID as $con) {
                  
          $stall = DB::table('tblContractInfo as contract')
                        ->join('tblStall as stall','contract.stallID','stall.stallID')
                        ->join('tblStall_Utilities as utility','stall.stallID','utility.stallID')
                        ->leftjoin('tblSubMeter as meter','utility.stallUtilityID','meter.stallUtilityID')
                        ->select('contract.*','stall.stallID as stallID','utility.*','meter.prevRead','meter.presRead','meter.readingFrom','meter.readingTo','meter.subMeterID')
                        ->where('contract.contractID','=', $con)
                        ->orderBy('meter.subMeterID','desc')
                        ->take(1) 
                        ->get(); 
                        array_push($stalls,$stall);  
            }
            
        return response()->json(['stalls'=>$stalls]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function previous($id){
         $previous = DB::table('tblMonthlyReading')
                        ->orderBy('readingID','desc')
                        ->where('utilType','=', $id)
                        ->first();
                        // ->get(); 
         return response()->json(['previous'=>$previous]);                           
    }
       public function submeter($id){
         $subReading = DB::table('tblSubMeter')
                        ->where('stallUtilityID','=', $id)
                        ->orderBy('subMeterID','desc')
                        ->first();
                        // ->get(); 
         return response()->json(['subReading'=>$subReading]);                           
    }
}
