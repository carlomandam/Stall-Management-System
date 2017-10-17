<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  public function __construct()
{
    $this->middleware('guest');
}

  

    public function index()
    {
        //
        return view('dashboard.index');
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
    public function layout($id){
        $tenants = DB::table('tblContractInfo as c')
                    ->join('tblStallHolder as t','t.stallHID','c.stallHID')
                    ->where('stallID','=',$id)
                    ->select('t.stallHFname as first','t.stallHMnAme as middle','t.stallHLname as last','c.stallID as stall')
                    ->get();
                    // return($tenants);
          $pdf = PDF::loadview('pdf.clearancepdf',compact('tenants'))->setPaper([0,0,612,396]);
        return $pdf->stream('pdf.clearancepdf'); 
    }
    public function back(){
        return view('dashboard.backup');
    }
}
