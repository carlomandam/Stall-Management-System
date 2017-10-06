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

        $monthly = DB::table('tblMonthlyReading')
                    ->orderBy('readingID','desc')
                    ->get();
                    // ->first();
        return view('transaction/PaymentAndCollection/Utilities.index',compact('monthly'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
        $rules = [
            'finalUtility' => 'required',
            'finalDateFrom'=> 'required',
            'finalDateTo'=> 'required',
            'finalPrevious'=> 'required|',
            'finalPresent'=> 'required|',
            'finalBillAmount'=> 'required|numeric',
            'finalMulti'=> 'required|numeric|',
            'finalUtilID.*'=> 'required',
            'finalSubPrev.*'=> 'required',
            'finalSubPres.*'=>'required',
            'finalSubAmount.*'=> 'required',
            'finalContractID.*'=> 'required'
        ];
        $messages = [
            
            'required' => 'The :attribute field is required.',
            'before' => 'The :attribute field must be before the other date.',
            'before_or_equal' => 'The :attribute field must be before or after the other date',
            'after'=> 'The :attribute field must be after the other date',
            'numeric'=> 'The :attribute field must be numeric',
            'max'=> 'The :attribute field reach the maximum value'

        ];
        $niceNames = [
            'finalUtility' => 'Utility Type',
            'finalDateFrom' => 'Date From',
            'finalDateTo' => 'Date To',
            'finalPrevious'=>'Previous Reading',
            'finalPresent'=> 'Present Reading',
            'finalBillAmount' => 'Toatal Bill Amount',
            'finalMulti' => 'Rate',
            'finalSubPrev' => 'SubMeter Previous Reading',
            'finalSubPres' => ' SubMeter Present Reading',
            'finalSubAmount' => 'SubMeter Bill Amount',
        ];


        $validator = Validator::make($request->all(),$rules,$messages);

        $validator->setAttributeNames($niceNames); 
        if($validator->passes()) {

            $monthlyReading = new MonthlyReading;
            $monthlyReading->prevReading = $request->finalPrevious;
            $monthlyReading->presReading = $request->finalPresent;
            $monthlyReading->readingFrom = $request->finalDateFrom;
            $monthlyReading->readingTo = $request->finalDateTo;
            $monthlyReading->totalBillAmount = $request->finalBillAmount;
            $monthlyReading->multiplier = $request->finalMulti;
            $monthlyReading->utilType = $request->finalUtility;

            $monthlyReading->save();
            
            $monthly = DB::table('tblMonthlyReading')
                        ->orderBy('readingID','desc')
                        ->select('readingID')
                        ->first();

            $readingID = $monthly->readingID;
            
            foreach ($request->meterID as $metID) {
                $metID = new UtilityMeterID([
                    'contractID'=> $metID['finalContractID'],
                    'readingID'=> $readingID,
                    'utilityAmt' => $metID['finalSubAmount']
                ]);
                $metID->save();
            
            }
            foreach ($request->subMeter as $meter) {
                $sub = new SubMeter([
                  'stallUtilityID' => $meter['finalUtilID'],
                  'prevRead' => $meter['finalSubPrev'],
                  'stallMeterID' => $readingID,
                  'presRead' => $meter['finalSubPres']
                  
                ]);
                $sub->save();
           
            }
            return response()->json(['success'=>'Added new records.']);
        }
        else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }



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
                        ->leftjoin('tblMonthlyReading as month','month.readingID','meter.readingID')
                        ->select('contract.*','stall.stallID as stallID','utility.*','meter.prevRead','meter.presRead','month.readingFrom','month.readingTo','meter.subMeterID')
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
    public function monthly(){
            
        // return($monthly);
            return response()->json(['monthly'=>$monthly]);                           
    }
    public function view($id){
            
            $monthly = DB::table('tblMonthlyReading as month')
                            ->where('month.readingID','=', $id)
                            ->first();
            $readingID = $monthly->readingID;
            $date = $monthly->readingFrom;
            // return($readingID);
            $reading = DB::table('tblMonthlyReading as month')
                            ->where('month.readingID','=',$id)
                            ->get();   
             // return ($reading);
             $subMeter = DB::table('tblStallUtilities_MeterID as meter')
                            // ->leftjoin('tblStall_Utilities as utility','utility.stallID','contract.stallID')
                            ->leftjoin('tblSubMeter as sub','sub.stallUtilityID','utility.stallUtilityID')
                            ->join('tblMonthlyReading as month','month.readingID','meter.readingID')
                            ->where('meter.readingID','=', $readingID)
                            ->where('')

                            ->select('meter.utilityAmt as subAmount')
                            ->get();
            return($subMeter);                          
            return view('transaction/PaymentAndCollection/Utilities.view',compact('reading','subMeter'));                          
    }
}
