<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use App\Collection;
use App\CollectionDetails;
use Carbon\Carbon;
use App\StallRate;
use App\Payment;
use App\Payment_Collection;
use DB;
use Validator;
use Illuminate\Validation\Rule;
use Response;
use Redirect;
class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /*  $contract =DB::select("Select stall.stallID as stallCode,CONCAT(stallH.stallHFName,' ',stallH.stallHMName,' ',stallH.stallHLName) as tenantName, tblcontractinfo.contractID as contractID, stall.businessName as businessName from tblstallrental_info as stall left join tblstallholder as stallH on stallH.stallHID = stall.stallHID LEFT JOIN tblcontractinfo on tblcontractinfo.stallRentalID = stall.stallRentalID where stall.stallRentalStatus = 1 and tblcontractinfo.contractStart <= NOW() and stall.deleted_at IS NULL");
         return view ('transaction/PaymentAndCollection/collectionTable',compact('contract'));*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       
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
        'dates' => 'required',
        'money' => 'required'
        ];
        $messages = [
        'required' => ':attribute field is required.',
        ];
        $attributeName =[
        'dates' => 'Date To',
        'money' => 'Amount'

        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($attributeName);
        $marketDays = []; 
            //dayOfWeek returns integer 0 if Sunday, and so on...

            // store yung marketDays as array
             $getMarketDays = DB::table('tblUtilities as a')
            ->where('utilitiesID','util_market_days') 
            ->select('utilitiesDesc')
            ->get();

            foreach($getMarketDays as $getDays)
            {   

                $marketDays = explode(",",$getDays->utilitiesDesc);
            
            }

            for($ctr = 0; $ctr < count($marketDays); $ctr++)
            {

                if($marketDays[$ctr] == "sun")
                {
                  $marketDays[$ctr] = 0;
                }
                else if($marketDays[$ctr] == "mon")
                {
                  $marketDays[$ctr] = 1;
                }
                else if($marketDays[$ctr] == "tue")
                {
                  $marketDays[$ctr] = 2;
                }
                else if($marketDays[$ctr] == "wed")
                {
                  $marketDays[$ctr] = 3;
                }
                else if($marketDays[$ctr] == "thur")
                {
                  $marketDays[$ctr] = 4;
                }
                else if($marketDays[$ctr] == "fri")
                {
                  $marketDays[$ctr] = 5;
                }
                else if($marketDays[$ctr] == "sat")
                {
                  $marketDays[$ctr] = 6;
                }
                else
                {
                  $marketDays[$ctr] = 7;
                }

            }
    if($validator->passes()){
           
            try{
             DB::beginTransaction();
            $newCollection = Collection::create([
                'contractID' => $request->contractID
            ]);

             $dates = $request->dates;
            $newPayment = Payment::create([
              'paymentDate' => Carbon::today(),
              'paidAmt' => $request->money              
              ]);
            foreach($dates as $date)
            {   
            $newColDetails = CollectionDetails::create([
                'collectionID' => $newCollection->collectionID,
                'collectDate' => $date
            ]);

            Payment_Collection::create([
              'paymentID' => $newPayment->paymentID,
              'collectionDetID' => $newColDetails->collectionDetID,
              'partialAmt' => '0',
              'isVoidOrRefund' => '0'
            ]);


            }
            
            DB::commit();
            return response()->json(['success'=>'Successfully Saved']);
            }
            catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return response()->json(['error'=>$error]);
            }
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
    }

    /**
     * Show the form for editing the specified resource.
     *x`
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

    public function viewCollections($id)
    {
         // $collections = Collection::where('contractID',$id)->get();
         $collections = DB::table('tblCollection as collect')
         ->select(DB::raw('collect.*, ( SELECT  cd.collectDate from tblcollection_details as cd where cd.collectionID = collect.collectionID ORDER BY cd.collectDate desc LIMIT 1) as lastDate, (SELECT cd.collectDate from tblcollection_details as cd  where cd.collectionID = collect.collectionID ORDER by cd.collectDate asc LIMIT 1) as firstDate'))
         ->where('collect.contractID',$id)
         ->orderBy('collect.created_at')
         ->get();
         $storeID = $id;
        
        foreach($collections as $collection)
        {
          $firstID = CollectionDetails::where('collectDate',$collection->firstDate)
         ->where('collectionID',$collection->collectionID)
         ->pluck('collectionDetID')
         ->first();
         $lastID = CollectionDetails::where('collectDate',$collection->lastDate)
         ->where('collectionID',$collection->collectionID)
         ->pluck('collectionDetID')->first();

            
        }
        return view ('transaction/PaymentAndCollection/collectionDetails',compact('storeID','collections','firstID','lastID'));
        
    }
    function showDetails($id,$endid)
    {
          //

        $contractID = CollectionDetails::find($id);

        $contract = Contract::find($contractID->Collection->contractID);
        
        $collectionFirst = CollectionDetails::where('collectionDetID',$id)->first();
        $collectionLast = CollectionDetails::where('collectionDetID',$endid)->first();
        $first = Carbon::parse($collectionFirst->collectDate)->format('F d,Y');
        $lastDate = Carbon::parse($collectionLast->collectDate)->format('F d,Y');
        

        // $first = "2017-09-24";
        // $last = "2017-09-27";
        $step = '+1 day';
        $output_format = 'Y-m-d';
        $dates = array();
        $current = strtotime($collectionFirst->collectDate);
        $last = strtotime($collectionLast->collectDate);
        $getIntegerDate =[];
        $data = array();
        while( $current <= $last ) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
         }

  
    foreach($dates as $date)
    {   
        $getIntegerDate[] = Carbon::parse($date)->dayOfWeek;

    }


  
   
      $getPeakDays = DB::table('tblUtilities as a')
            ->where('utilitiesID','util_peak_days') 
            ->select('utilitiesDesc')
            ->get();

       $peakDays = []; 
            //dayOfWeek returns integer 0 if Sunday, and so on...

            // store yung marketDays as array
            foreach($getPeakDays as $getDays)
            {   

                $peakDays = explode(",",$getDays->utilitiesDesc);
            
            }

            for($ctr = 0; $ctr < count($peakDays); $ctr++)
            {

                if($peakDays[$ctr] == "sun")
                {
                  $peakDays[$ctr] = 0;
                }
                else if($peakDays[$ctr] == "mon")
                {
                  $peakDays[$ctr] = 1;
                }
                else if($peakDays[$ctr] == "tue")
                {
                  $peakDays[$ctr] = 2;
                }
                else if($peakDays[$ctr] == "wed")
                {
                  $peakDays[$ctr] = 3;
                }
                else if($peakDays[$ctr] == "thur")
                {
                  $peakDays[$ctr] = 4;
                }
                else if($peakDays[$ctr] == "fri")
                {
                  $peakDays[$ctr] = 5;
                }
                else if($peakDays[$ctr] == "sat")
                {
                  $peakDays[$ctr] = 6;
                }
                else
                {
                  $peakDays[$ctr] = 7;
                }

            }

             $getMarketDays = DB::table('tblUtilities as a')
            ->where('utilitiesID','util_market_days') 
            ->select('utilitiesDesc')
            ->get();

            $marketDays = []; 
            //dayOfWeek returns integer 0 if Sunday, and so on...

            // store yung marketDays as array
            foreach($getMarketDays as $getDays)
            {   

                $marketDays = explode(",",$getDays->utilitiesDesc);
            
            }

            for($ctr = 0; $ctr < count($marketDays); $ctr++)
            {

                if($marketDays[$ctr] == "sun")
                {
                  $marketDays[$ctr] = 0;
                }
                else if($marketDays[$ctr] == "mon")
                {
                  $marketDays[$ctr] = 1;
                }
                else if($marketDays[$ctr] == "tue")
                {
                  $marketDays[$ctr] = 2;
                }
                else if($marketDays[$ctr] == "wed")
                {
                  $marketDays[$ctr] = 3;
                }
                else if($marketDays[$ctr] == "thur")
                {
                  $marketDays[$ctr] = 4;
                }
                else if($marketDays[$ctr] == "fri")
                {
                  $marketDays[$ctr] = 5;
                }
                else if($marketDays[$ctr] == "sat")
                {
                  $marketDays[$ctr] = 6;
                }
                else
                {
                  $marketDays[$ctr] = 7;
                }

            }

  
    $rates = StallRate::find($contract->stallRateID);
    $regularRate = $rates->dblRate;
    $amount = [];
    $totalAmt = 0;
    if($rates->peakRateType == 1){
    $peakDaysRate = $rates->dblPeakRate + $rates->dblRate;
    }
    else{
    $peakDaysRate = ($regularRate)*(($rates->dblPeakRate / 100)) + $regularRate;
    }

    $ctr = 0;
    foreach($getIntegerDate as $Gdates)
    { 

        if(in_array($Gdates, $peakDays) && in_array($Gdates, $marketDays))
        {
            $amount[$ctr] = number_format($peakDaysRate);
            $totalAmt += $amount[$ctr];
        }
        else if(in_array($Gdates, $marketDays)){
          $amount[$ctr] = number_format($regularRate);
          $totalAmt += $amount[$ctr];
        }
        else
        {
           $amount[$ctr] = 0;
           $totalAmt += $amount[$ctr];
        }
        $ctr++;
    }
   
    $size = count($dates);
    $ctr = 0;

    while($ctr < $size)
    {
        $data[$ctr]["date"] = $dates[$ctr];
        if(!$amount[$ctr]== 0)
        {
          $data[$ctr]['desc'] = "Rental Fee for " . Carbon::parse($dates[$ctr])->format('l');
          $data[$ctr]['amount'] = number_format($amount[$ctr],2);
      }
        else
        {
            $data[$ctr]['desc'] = "Not a Market Day";
            $data[$ctr]['amount'] = "0.00";
        }


        $ctr++;

    }
    $totalAmt = number_format($totalAmt,2);
          return view('transaction/PaymentAndCollection/collectionViewCollection',compact('contract','id','first','lastDate','data','totalAmt'));

    }

    function getCollections()
    {
         $first = $_GET['dateFrom'];
         $last = $_GET['dateTo'];
        // $first = "2017-09-24";
        // $last = "2017-09-27";
        $step = '+1 day';
        $output_format = 'Y-m-d';
        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);
        $getIntegerDate =[];
      
    while( $current <= $last ) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }
    
    foreach($dates as $date)
    {   
        $getIntegerDate[] = Carbon::parse($date)->dayOfWeek;
    }
  
   
      $getPeakDays = DB::table('tblUtilities as a')
            ->where('utilitiesID','util_peak_days') 
            ->select('utilitiesDesc')
            ->get();

       $peakDays = []; 
            //dayOfWeek returns integer 0 if Sunday, and so on...

            // store yung marketDays as array
            foreach($getPeakDays as $getDays)
            {   

                $peakDays = explode(",",$getDays->utilitiesDesc);
            
            }

            for($ctr = 0; $ctr < count($peakDays); $ctr++)
            {

                if($peakDays[$ctr] == "sun")
                {
                  $peakDays[$ctr] = 0;
                }
                else if($peakDays[$ctr] == "mon")
                {
                  $peakDays[$ctr] = 1;
                }
                else if($peakDays[$ctr] == "tue")
                {
                  $peakDays[$ctr] = 2;
                }
                else if($peakDays[$ctr] == "wed")
                {
                  $peakDays[$ctr] = 3;
                }
                else if($peakDays[$ctr] == "thur")
                {
                  $peakDays[$ctr] = 4;
                }
                else if($peakDays[$ctr] == "fri")
                {
                  $peakDays[$ctr] = 5;
                }
                else if($peakDays[$ctr] == "sat")
                {
                  $peakDays[$ctr] = 6;
                }
                else
                {
                  $peakDays[$ctr] = 7;
                }

            }

             $getMarketDays = DB::table('tblUtilities as a')
            ->where('utilitiesID','util_market_days') 
            ->select('utilitiesDesc')
            ->get();

            $marketDays = []; 
            //dayOfWeek returns integer 0 if Sunday, and so on...

            // store yung marketDays as array
            foreach($getMarketDays as $getDays)
            {   

                $marketDays = explode(",",$getDays->utilitiesDesc);
            
            }

            for($ctr = 0; $ctr < count($marketDays); $ctr++)
            {

                if($marketDays[$ctr] == "sun")
                {
                  $marketDays[$ctr] = 0;
                }
                else if($marketDays[$ctr] == "mon")
                {
                  $marketDays[$ctr] = 1;
                }
                else if($marketDays[$ctr] == "tue")
                {
                  $marketDays[$ctr] = 2;
                }
                else if($marketDays[$ctr] == "wed")
                {
                  $marketDays[$ctr] = 3;
                }
                else if($marketDays[$ctr] == "thur")
                {
                  $marketDays[$ctr] = 4;
                }
                else if($marketDays[$ctr] == "fri")
                {
                  $marketDays[$ctr] = 5;
                }
                else if($marketDays[$ctr] == "sat")
                {
                  $marketDays[$ctr] = 6;
                }
                else
                {
                  $marketDays[$ctr] = 7;
                }

            }

    $contract = Contract::find($_GET['contractID']);
  
    $rates = StallRate::find($contract->stallRateID);
    $regularRate = $rates->dblRate;
    $amount = [];

    if($rates->peakRateType == 1){
    $peakDaysRate = $rates->dblPeakAdditional + $rates->dblRate;
    }
    else{
    $peakDaysRate = ($regularRate)*(($rates->dblPeakRate / 100)) + $regularRate;
    }
  
    $ctr = 0;
    foreach($getIntegerDate as $Gdates)
    {

        if(in_array($Gdates, $peakDays) && in_array($Gdates, $marketDays))
        {
            $amount[$ctr] = number_format($peakDaysRate);
        }
        else if(in_array($Gdates, $marketDays)){
          $amount[$ctr] = number_format($regularRate);
        }
        else
        {
           $amount[$ctr] = 0;
        }
        $ctr++;
    }

    $size = count($dates);
    $ctr = 0;
    $data2 = array();
    while($ctr < $size)
    {   
        $data[$ctr]["date"] = $dates[$ctr];
        if(!$amount[$ctr]== 0)
        {$data[$ctr]['cb'] = "<input type = 'checkbox' id='chk'/>";
          $data[$ctr]['desc'] = "Rental Fee for " . Carbon::parse($dates[$ctr])->format('l');
          $data[$ctr]['amount'] = number_format($amount[$ctr],2);
      }
        else
        {   $data[$ctr]['cb'] = "<input type = 'checkbox' disabled />";
            $data[$ctr]['desc'] = "Not a Market Day";
            $data[$ctr]['amount'] = "0.00";
        }


       
        $ctr++;

    }
   
      
      return response()->json($data);
    }

}
