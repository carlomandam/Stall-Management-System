<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRental;
use App\StallHolder;
use App\Stall;
use App\RequestT;
use App\RequestInfo;
use Carbon\Carbon;
use DB;
use Response;
use Validator;
use Redirect;

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
        
        $reqs = DB::table('tblRequest as request')
                    ->join('tblStallHolder as holder','holder.stallHID','request.stallHID')
                    ->get();
        
        return view('transaction/Requests.index',compact('reqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $today= Carbon::now();
         $tenants = DB::table('tblStallHolder as tenants')
                    ->rightjoin('tblContractInfo as contract','tenants.stallHID','contract.stallHID')
                    ->where('contract.contractStart','<=', $today)
                    ->whereNull('contract.deleted_at')
                    ->whereNull('contract.contractReason')
                    ->orderBy('contract.contractID', 'asc')
                    ->groupBy('contract.stallHID')
                    ->select('tenants.stallHFName as firstName','tenants.stallHMName as middleName','tenants.stallHLName as lastName','tenants.stallHID as id')
                    ->get();
        // return($tenants);
        return view('transaction/Requests.create',compact('tenants'));
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
   
    public function current($id){

            $current = DB::table('tblContractInfo as contract')
                             ->where('contract.stallHID','=',$id)
                             ->whereNull('contract.deleted_at')
                             ->whereNull('contract.contractReason')
                             ->orderBy('contract.contractID', 'asc')
                            ->get();
            return response()->json(['current'=>$current]);
    }

    public function desire($id){

            $desire = Stall::with('StallType.StallRate','StallType.StallType','StallType.StallTypeSize','Floor.Building')
                            ->doesntHave('CurrentTennant')
                            ->get();
            return response()->json(['desire'=>$desire]);
    
    }
     public function SaveTransferStall(Request $request){

         $rules = [
            'requestType' => 'required',
            'tenant'=> 'required',
            'reason'=> 'nullable',
            'status'=> 'required',
            'stallFrom.*'=> 'required',
            'stallTo.*'=> 'nullable',
         
        ];
        $messages = [
            
            'required' => 'The :attribute field is required.',
          

        ];
        $niceNames = [
            'requestType' => 'Request Type',
            'tenant' => 'Stall Holder',
            'finalDateTo' => 'Date To',
   
        ];
         $today = Carbon::now();
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames);
             if($validator->passes()) {

            $req = new RequestT;
            $req->requestType = $request->requestType;
            $req->stallHID = $request->tenant;
            $req->requestText = $request->reason;
            $req->status = $request->status;
            $req->submitDate = $today;

            $req->save();
            
            $reqs = DB::table('tblRequest')
                        ->orderBy('requestID','desc')
                        ->select('requestID')
                        ->first();

            $reqID = $reqs->requestID;

            foreach ($request->stallRequested as $stallReq) {
                $reqInfo = new RequestInfo([
                  'requestID' => $reqID,
                  'contractID' => $stallReq['stallFrom'],
                  'stallRequested' => $stallReq['stallTo']
               
                ]);
                $reqInfo->save();
            }
            
         
            
            return response()->json(['success'=>'Added new records.']);
        }
          else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }

    }
     public function SaveLeaveStall(Request $request){

         $rules = [
            'requestType' => 'required',
            'tenant'=> 'required',
            'reason'=> 'nullable',
            'status'=> 'required',
            // 'stallFrom.*'=> 'required'
         
        ];
        $messages = [
            
            'required' => 'The :attribute field is required.',
          

        ];
        $niceNames = [
            'requestType' => 'Request Type',
            'tenant' => 'Stall Holder',
            'finalDateTo' => 'Date To',
   
        ];
         $today = Carbon::now();
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames);
             if($validator->passes()) {

            $req = new RequestT;
            $req->requestType = $request->requestType;
            $req->stallHID = $request->tenant;
            $req->requestText = $request->reason;
            $req->status = $request->status;
            $req->submitDate = $today;

            $req->save();
            
            $reqs = DB::table('tblRequest')
                        ->orderBy('requestID','desc')
                        ->select('requestID')
                        ->first();

            $reqID = $reqs->requestID;

            foreach ($request->stallRequested as $stallReq) {
                $reqInfo = new RequestInfo;
                $reqInfo->requestID = $reqID;
                $reqInfo->contractID = $stallReq;
                $reqInfo->save();
            }
            
         
            
            return response()->json(['success'=>'Added new records.']);
        }
          else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }

    }
    public function View($id){

        $req = DB::table('tblRequest as request')
                ->join('tblStallHolder as holder','request.stallHID','holder.stallHID')
                ->where('request.requestID','=', $id)
                // ->groupBy('request.requestID')
                ->select('request.requestType as Type','holder.stallHFName as First','holder.stallHMName as Middle','holder.stallHLName as Last','request.status as status','request.requestText as reason','request.requestID as ID')
                ->get();
        
               
    }
}
