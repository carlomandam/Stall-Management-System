<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requirements;
use DB;
use Response;
use Validator;
use Redirect;

class RequirementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $requirements = Requirements::whereNull('deleted_at')
                                        ->get();
        return view ('Requirements/index',compact('requirements'));

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
        $rules = [
            'newReqName' => 'required|unique:tblRequirements,reqName|max:200',
            'newReqDesc' => 'nullable|max:200',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
        ];
        $niceNames = [
            'newReqName' => 'Requirement',
            'newReqDesc' => 'Description',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
         if ($validator->passes()) {

            $requirements = new Requirements;
            $requirements->reqName = $request->newReqName;
            $requirements->reqDesc = $request->newReqDesc;
            $requirements->save();
            // $request->session()->flash('status', 'Task was successful!');
            // return Response::make(json_encode($errors), 200);
            // return Redirect::back();
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
        $req = Requirements::findOrFail($id);
        // return ($req);
                            
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
        $rules = [
            'editReqName' => 'required|unique:tblRequirements,reqName|max:200',
            'editReqDesc' => 'nullable|max:200',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
        ];
        $niceNames = [
            'editReqName' => 'Requirement',
            'editReqDesc' => 'Description',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
         if ($validator->passes()) {

            $requirements = new Requirements;
            $requirements->reqName = $request->editReqName;
            $requirements->reqDesc = $request->editReqDesc;
            $requirements->save();
            return response()->json(['success'=>'Update new records.']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
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
    	// $requirements = Requirements::findOrFail($id)->get();
    	// return($requirements);

        $rules = [
            'editReqName' => 'required|unique:tblRequirements,reqName|max:200',
            'editReqDesc' => 'nullable|max:200',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
        ];
        $niceNames = [
            'editReqName' => 'Requirement',
            'editReqDesc' => 'Description',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 

         if ($validator->passes()) {
         	
            $requirements = Requirements::findOrFail($id);
            
            $requirements->reqName = $request->editReqName;
            $requirements->reqDesc = $request->editReqDesc;
            $requirements->save();
            return response()->json(['success'=>'Update new records.']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
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
}
