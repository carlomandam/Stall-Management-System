<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use App\Floor;
use App\StallType_StallTypeSize;
use App\StallTypeSize;
use App\StallRate;
use App\Frequency;
use App\Stall;
use App\StallType;
use App\StallRateDetail;
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
        $types = StallType_StallTypeSize::with('StallType','StallTypeSize')
                                        ->get();
        $rates = StallRate::with('StallRateDetail')
                            ->get();
                                 
         // return ($types);           
        return View('/KioskMap/index',compact('buildings','types','rates'));
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
