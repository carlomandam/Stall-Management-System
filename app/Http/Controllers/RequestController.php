<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRental;
use App\StallHolder;
use App\Stall;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        

        // return ($stalls);

        return view('transaction/Requests/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $stalls = StallHolder::with('ActiveStallRental.Contract')->has('ActiveStallRental.Contract')->get();
         $avails = Stall::with('Floor.Building')->withCount('Pending')->has('StallType.StallRate.RateDetail')->doesntHave('CurrentTennant')->get();
        // return ($stalls);
        return view('transaction/Requests/create',compact('stalls','avails'));
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
        return view('transaction/Requests/show');
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
    public function getStall($id){
        $active = StallHolder::with('ActiveStallRental.Contract')
                             ->has('ActiveStallRental.Contract')
                             ->findOrFail($id);
        // return($active);
        return response()->json(['active'=>$active]);
    }
    public function getAvail(){
         
        return($avail);
        
    }

}
