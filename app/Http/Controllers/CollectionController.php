<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use App\Collection;
use App\CollectionDetails;
use Carbon\Carbon;
use App\StallRate;
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
         $contract =DB::select("Select stall.stallID as stallCode,CONCAT(stallH.stallHFName,' ',stallH.stallHMName,' ',stallH.stallHLName) as tenantName, tblcontractinfo.contractID as contractID, stall.businessName as businessName from tblstallrental_info as stall left join tblstallholder as stallH on stallH.stallHID = stall.stallHID LEFT JOIN tblcontractinfo on tblcontractinfo.stallRentalID = stall.stallRentalID where stall.stallRentalStatus = 1 and tblcontractinfo.contractStart <= NOW() and stall.deleted_at IS NULL");
         return view ('transaction/PaymentAndCollection/collectionTable',compact('contract'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $contract = Contract::find($id);
        $lastCollection = Collection::whereRaw('collectionID = (SELECT MAX(`collectionID`)FROM tblCollection)')
            ->where('contractID',$id)
            ->pluck('collectionID')
            ->first();
        if(count($lastCollection) > 0){
         $collectionDetails = CollectionDetails::where('collectionID',$lastCollection)
        ->orderBy('collectDate','desc')
        ->pluck('collectDate')
        ->first();

        $collectionDetails = Carbon::parse($collectionDetails)
        ->addDays(1)
        ->format('Y-m-d');
        $nextCollection = Carbon::parse($collectionDetails)
        ->addDays(1)
        ->format('Y-m-d');
        }

        else{

            $collectionDetails = Carbon::parse($contract->contractStart)
            ->format('Y-m-d');
            $nextCollection = Carbon::parse($collectionDetails)
            ->addDays(1)
            ->format('Y-m-d');
        }

        return view('transaction/PaymentAndCollection/collectionIndex',compact('contract','id','collectionDetails','nextCollection'));
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
        'dateTo' => 'required',
        ];
        $messages = [
        'required' => ':attribute field is required.',
        ];
        $attributeName =[
        'dateTo' => 'Date To',
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
            $first = $request->dateFrom;
            $last = $request->dateTo;
            $step = '+1 day';
            $output_format = 'Y-m-d';
            $dates = array();
            $current = strtotime($first);
            $last = strtotime($last);
          
      
          
            while( $current <= $last ) {

                $thisDate = date($output_format, $current);
                $thisDate = Carbon::parse($thisDate)->dayOfWeek;
                if(in_array($thisDate, $marketDays))
                {
                    $dates[] = date($output_format,$current);
                }

                $current = strtotime($step, $current);
            }
        if($validator->passes()){
           
            try{
             DB::beginTransaction();
            $newCollection = Collection::create([
                'contractID' => $request->contractID
            ]);

            
            foreach($dates as $date)
            {   
            CollectionDetails::create([
                'collectionID' => $newCollection->collectionID,
                'collectDate' => $date
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

    public function viewCollections($id)
    {
         // $collections = Collection::where('contractID',$id)->get();
         $collections = DB::table('tblCollection as collect')
         ->select(DB::raw('collect.*, ( SELECT  cd.collectDate from tblcollection_details as cd where cd.collectionID = collect.collectionID ORDER BY cd.collectDate desc LIMIT 1) as lastDate, (SELECT cd.collectDate from tblcollection_details as cd  where cd.collectionID = collect.collectionID ORDER by cd.collectDate asc LIMIT 1) as firstDate'))
         ->where('collect.contractID',$id)
         ->orderBy('collect.created_at')
         ->get();
         $storeID = $id;

       
           return view ('transaction/PaymentAndCollection/collectionDetails',compact('storeID','collections'));
        
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
        $data = [[]];
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
   
    
     return response()->json($data);
    }

}
