<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRental;
use App\StallHolder;
use App\Stall;
use App\RequestT;
use App\RequestInfo;
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
        $reqs = RequestT::with('Rental.StallHolder')
                        ->whereNull('deleted_at')
                        ->get();
        // return ($reqs);
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
        $stalls = StallHolder::with('ActiveStallRental.Contract')->has('ActiveStallRental.Contract')->get();
         $avails = Stall::with('Floor.Building')->withCount('Pending')->has('StallType.StallRate.RateDetail')->doesntHave('CurrentTennant')->get();
         
        // return ($avails);
        
        return view('transaction/Requests.create',compact('stalls','avails'));
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
        if($request->newType==1){
             $rules = [
             'newRentalID'=> 'required',
             'newType'=> 'required',
             'newDesc'=> 'nullable|max:300',
             'newStatus'=> 'required',
             'newRemarks'=> 'nullable',
             'newApprovedDate' =>'nullable',
             'newRentTo'=> 'required',
             ];
             $messages = [
             'unique' => ':attribute already exists.',
             'required' => 'The :attribute field is required.',
             'max' => 'The :attribute field must be no longer than :max characters.',
             ];
             $niceNames = [
             'newRentalID'=> 'Stall',
             'newType'=> 'Request Type',
             'newRentTo' => 'Transfer Stall Code',
             ];
             $validator = Validator::make($request->all(),$rules,$messages);
             $validator->setAttributeNames($niceNames); 
             if ($validator->passes()) {

                $req = new RequestT;
                $req->stallRentalID = $request->newRentalID;
                $req->requestType =$request->newType;
                $req->requestText= $request->newDesc;
                $req->status = $request->newStatus;
                $req->remarks = $request->newRemarks;
                $req->approvedDate = $request->newApprovedDate; 
               
                if( $req->save()){
                     $reqInfo = new RequestInfo;
                     $reqInfo->requestID = $req->requestID;
                     $reqInfo->stallRequested = $request->newRentTo;
                     $reqInfo->save();
                return response()->json(['success'=>'Added new records.']);
                }
               
                }
            else{
               return response()->json(['error'=>$validator->errors()->all()]);
           }
        }

        else if($request->newType==2){
             $rules = [
             'newRentalID'=> 'required',
             'newType'=> 'required',
             'newDesc'=> 'nullable|max:300',
             'newStatus'=> 'required',
             'newRemarks'=> 'nullable',
             'newApprovedDate' =>'nullable',
             ];
             $messages = [
             'unique' => ':attribute already exists.',
             'required' => 'The :attribute field is required.',
             'max' => 'The :attribute field must be no longer than :max characters.',
             ];
             $niceNames = [
             'newRentalID'=> 'Stall',
             'newType'=> 'Request Type',
             'newRentTo' => 'Transfer Stall Code',
             ];
             $validator = Validator::make($request->all(),$rules,$messages);
             $validator->setAttributeNames($niceNames); 
             if ($validator->passes()) {

                $req = new RequestT;
                $req->stallRentalID = $request->newRentalID;
                $req->requestType =$request->newType;
                $req->requestText= $request->newDesc;
                $req->status = $request->newStatus;
                $req->remarks = $request->newRemarks;
                $req->approvedDate = $request->newApprovedDate; 
               $req->save();
               return response()->json(['success'=>'Added new records.']);
               
                }
                else{
                    return response()->json(['error'=>$validator->errors()->all()]);
                }
        }

        else if($request->newType==3){
             $rules = [
             'newRentalID'=> 'required',
             'newType'=> 'required',
             'newDesc'=> 'nullable|max:300',
             'newStatus'=> 'required',
             'newRemarks'=> 'nullable',
             'newApprovedDate' =>'nullable',
             ];
             $messages = [
             'unique' => ':attribute already exists.',
             'required' => 'The :attribute field is required.',
             'max' => 'The :attribute field must be no longer than :max characters.',
             ];
             $niceNames = [
             'newRentalID'=> 'Stall',
             'newType'=> 'Request Type',
             'newRentTo' => 'Transfer Stall Code',
             ];
             $validator = Validator::make($request->all(),$rules,$messages);
             $validator->setAttributeNames($niceNames); 
             if ($validator->passes()) {

                $req = new RequestT;
                $req->stallRentalID = $request->newRentalID;
                $req->requestType =$request->newType;
                $req->requestText= $request->newDesc;
                $req->status = $request->newStatus;
                $req->remarks = $request->newRemarks;
                $req->approvedDate = $request->newApprovedDate; 
               $req->save();
               return response()->json(['success'=>'Added new records.']);
               
                }
                else{
                    return response()->json(['error'=>$validator->errors()->all()]);
                }
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
        $req = RequestT::with('Rental.StallHolder')
                        ->with('RequestInfo')
                        ->whereNull('deleted_at')
                        ->findorFail($id);
        return response()->json(['req'=>$req]);
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



        $rID = $request->rentalID;
        $req = RequestT::findorFail($id);
        $con = StallRental::findorFail($rID);       
        if($request->updateStatus==1){
            $con->stallRentalStatus = 0;
            $req->status = $request->updateStatus;
            $req->remarks = $request->newRemarks;
            $req->approvedDate = $request->approved;
            $req->save();
        }


        
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
                             ->findorFail($id);
        
        // return($active);
        return response()->json(['active'=>$active]);
    }
    public function getAvail(){
         
        return($avail);
        
    }

}
