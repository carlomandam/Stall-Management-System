<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use App\StallUtility;
use App\MonthlyReading;
use App\UtilityMeterID;

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
        $monthlyReading = new MonthlyReading;
        $monthlyReading->prevReading = $request->finalPrevious;
        $monthlyReading->presReading = $request->finalPresent;
        $monthlyReading->readingFrom = $request->finalDateFrom;
        $monthlyReading->readingTo = $request->finalDateTo;
        $monthlyReading->totalBillAmount = $request->finalBillAmount;
        $monthlyReading->multiplier = $request->finalMulti;
        $monthlyReading->utilType = $request->finalUtility;

        // $contractMeter = new UtilityMeterID;
        $monthlyReading->save();




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
         $stalls = DB::table('tblContractInfo as contract')
                        ->join('tblStall as stall','contract.stallID','stall.stallID')
                        ->join('tblStall_Utilities as utility','stall.stallID','utility.stallID')
                        ->leftjoin('tblSubMeter as meter','utility.stallUtilityID','meter.stallUtilityID')
                        ->select('contract.*','stall.stallID as stallID','utility.*','meter.*')
                        ->where('utility.utilityType','=', $id)
                        ->whereNotNull('contractStart')
                        ->get();
            
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
