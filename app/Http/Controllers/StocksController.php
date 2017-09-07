<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\EquipStocks;
use DB;
use Response;
use Validator;
use Redirect;

class StocksController extends Controller
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
        $quantity = EquipStocks::all();
        return view ('/transaction.Inventory.Stocks.index',compact('equips','quantity'));
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
            'quantity' => 'required',
        ];
        $messages = [
            'required' => 'The :attribute field is required.',
        ];
        $niceNames = [
            'quantity' => 'Quantity',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 

         if ($validator->passes()) {
            
            $stock = new EquipStocks;
            
            $stock->equipmentID = $request->eqID;
            $stock->stockStatus = $request->status;
            $stock->stockQty = $request->quantity;
        
            $stock->save();
            return response()->json(['success'=>'Stock Added.']);
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
