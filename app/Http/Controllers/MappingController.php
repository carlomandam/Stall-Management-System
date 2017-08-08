<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use App\Floor;
use App\StallTypeStallSize;
use App\StallTypeSize;
use App\StallRate;
use App\Frequency;
use App\Stall;
use DB;
use Response;

class MappingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Building::all();
        $rates = DB::table('tblstallType_stallSize as s')
                    ->join('tblStallType as st' , 'st.stypeID' , 's.stypeID')
                    ->join('tblStallType_Size as ss', 'ss.stypeSizeID', 's.stypeSizeID')
                    ->join('tblStallRate as r','r.stype_SizeID','s.stype_SizeID')
                    ->join('tblFrequency as f', 'f.frequencyID', 'r.frequencyID')
                    ->join('tblStallRate_Details as sd', 'sd.stallRateID', 'r.stallRateID')
                    ->get();
         // return ($rates);           
        return View('/KioskMap/index',compact('buildings','rates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    public function load($id)
    {   

         $building = Building::with('Floor')->findOrFail($id);
        return response()->json(['bldg'=>$building]);
         // return ($building);
    }
    public function floor($id)
    {   

         $floor = Floor::with('Stall')->findOrFail($id);
         // return ($floor);
        return response()->json(['floor'=>$floor]);
        return ($floor);

    }
}
