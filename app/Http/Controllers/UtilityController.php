<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRental;
use App\Contract;
use App\StallUtility;
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
                        ->join('tblStallRental_Info as rental','contract.stallRentalID','rental.stallRentalID')
                        ->join('tblStall as stall','rental.stallID','stall.stallID')
                        ->join('tblStall_Utilities as utility','stall.stallID','utility.stallID')
                        ->leftjoin('tblSubMeter as meter','utility.stallUtilityID','meter.stallUtilityID')
                        ->select('contract.*','stall.stallID as stallID','utility.utilityType as utilityType','meter.*')
                        ->where('utility.utilityType','=', $id)
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
}
