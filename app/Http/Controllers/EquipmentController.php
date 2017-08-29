<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use DB;
use Response;
use Validator;
use Redirect;


class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $equips = Equipment::whereNull('deleted_at')
                            ->get();
        return view('Equipments.index',compact('equips'));
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
            'newEquipment' => 'required|unique:tblEquipment,equipmentName|max:200',
            'newRate' => 'required',
            'newLimit' => 'required',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
        ];
        $niceNames = [
            'newEquipment' => 'Equipment Name',
            'newRate' => 'Daily Rate',
            'newLimit' => 'Limit per Stall',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 

         if ($validator->passes()) {
            
            $equip = new Equipment;
            
            $equip->equipmentName = $request->newEquipment;
            $equip->rentDailyRate = $request->newRate;
            $equip->equipStallLimit = $request->newLimit;
            $equip->save();
            return response()->json(['success'=>'Update new records.']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);

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
        $equip =Equipment::findorFail($id);
        return response()->json(['equip'=>$equip]);
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
          $rules = [
            'uEquipment' => 'required|unique:tblEquipment,equipmentName|max:200',
            'uRate' => 'required',
            'uLimit' => 'required',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
        ];
        $niceNames = [
            'uEquipment' => 'Equipment Name',
            'uRate' => 'Daily Rate',
            'uLimit' => 'Limit per Stall',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 

         if ($validator->passes()) {
            
            $equip = Equipment::findorFail($id);
            
            $equip->equipmentName = $request->uEquipment;
            $equip->rentDailyRate = $request->uRate;
            $equip->equipStallLimit = $request->uLimit;
            $equip->save();
            return response()->json(['success'=>'Update new records.']);
        }
        else{
            
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
