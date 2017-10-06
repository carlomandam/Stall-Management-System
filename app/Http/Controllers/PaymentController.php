<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRental;
use App\Contract;
use App\Billing;
use App\Payment;
use App\StallHolder;
use App\StallRate;
use App\Utilities;
use App\Collection;
use App\CollectionDetails;
use App\Payment_Collection;
use DateTime;
use PDF;
use PDFF;
use DB;
use DateTimeZone;
use Carbon\Carbon;
use DatePeriod;
use DateInterval;
class PaymentController extends Controller{
   public function index(){   
        $totalUnpaid =[[]];

        $stalls =DB::select("Select stallID as stallCode,CONCAT(stallH.stallHFName,' ',stallH.stallHLName) as tenantName, contractID as contractID from tblcontractInfo left join tblstallholder as stallH on stallH.stallHID = tblcontractInfo.stallHID where tblcontractInfo.deleted_at IS NULL");

        $getPeakDays = DB::table('tblUtilities as a')
        ->where('utilitiesID','util_peak_days') 
        ->select('utilitiesDesc')
        ->get();

        $peakDays = [];
        foreach($getPeakDays as $getDays){
            $peakDays = explode(",",$getDays->utilitiesDesc);
        }

        for($ctr = 0; $ctr < count($peakDays); $ctr++){
            if($peakDays[$ctr] == "sun"){
                  $peakDays[$ctr] = 0;
              }
              else if($peakDays[$ctr] == "mon"){
                  $peakDays[$ctr] = 1;
              }
              else if($peakDays[$ctr] == "tue"){
                  $peakDays[$ctr] = 2;
              }
              else if($peakDays[$ctr] == "wed"){
                  $peakDays[$ctr] = 3;
              }
              else if($peakDays[$ctr] == "thur"){
                  $peakDays[$ctr] = 4;
              }
              else if($peakDays[$ctr] == "fri"){
                  $peakDays[$ctr] = 5;
              }
              else if($peakDays[$ctr] == "sat"){
                  $peakDays[$ctr] = 6;
              }
              else{
                  $peakDays[$ctr] = 7;
              }
        }

        $unpaidCollections = DB::select('Select det.collectDate as collectDate, det.collectionID as collectionID,collect.contractID as contractID  FROM tblcollection_details as det LEFT JOIN tblpayment_collection as payment on payment.collectionDetID = det.collectionDetID LEFT JOIN tblcollection as collect on collect.collectionID = det.collectionID WHERE payment.collectionDetID IS NULL and det.collectDate <= NOW() ORDER BY collect.contractID');

        $lastValue = null;
        $totalAmt = 0;
        $ctr = 0;
        $count = count($unpaidCollections);
        $lastCtr = 1;

        foreach($unpaidCollections as $unpaid){
            $stallRateID = Contract::find($unpaid->contractID)->pluck('stallRateID')->first();
            $stallRateID = StallRate::find($stallRateID);

            $regularRate = $stallRateID->dblRate;
            if($stallRateID->peakRateType == 1){
                $peakDaysRate = $stallRateID->dblPeakRate + $stallRateID->dblRate;
            }
            else{
                $peakDaysRate = ($regularRate)*(($stallRateID->dblPeakRate / 100)) + $regularRate;
            }

            if(in_array(Carbon::parse($unpaid->collectDate)->dayOfWeek, $peakDays)){
                $totalAmt += $peakDaysRate;
            }
            else{
                $totalAmt += $regularRate;
            }

            if($lastValue != $unpaid->contractID){
              $totalUnpaid[$ctr]["contractID"] = $lastValue;
              $totalUnpaid[$ctr]["totalUnpaid"] = $totalAmt;
              $totalAmt = 0;
              $ctr++;
            }
            
            $lastCtr++;
            $lastValue = $unpaid->contractID;
        } 
            
        $collectionStat = Utilities::find("util_collection_status");
          
        return view('transaction/PaymentAndCollection/finalPayment',compact('collectionStat','stalls'));
    }

    public function getRate($dates,$rateID){
        $rates = StallRate::find($rateID);
        $regularRate = $rates->dblRate;

        if($rates->peakRateType == 1){
            $peakDaysRate = $rates->dblPeakAdditional + $rates->dblRate;
        }
        else{
            $peakDaysRate = ($regularRate)*(($rates->dblPeakAdditional / 100)) + $regularRate;
        }

        $getPeakDays = DB::table('tblUtilities as a')
            ->where('utilitiesID','util_peak_days') 
            ->select('utilitiesDesc')
            ->get();

        $getMarketDays = DB::table('tblUtilities as a')
        ->where('utilitiesID','util_market_days') 
        ->select('utilitiesDesc')
        ->get();

        $marketDays = explode(",",$getMarketDays[0]->utilitiesDesc);
        $peakDays = explode(",",$getPeakDays[0]->utilitiesDesc);
        //$holidays = Holiday::all();

        for($ctr = 0; $ctr < count($peakDays); $ctr++){ 
              $peakDays[$ctr] = PaymentController::dateStrToInt($peakDays[$ctr]);
        }

        for($ctr = 0; $ctr < count($marketDays); $ctr++){
              $marketDays[$ctr] = PaymentController::dateStrToInt($marketDays[$ctr]);
        }

        $collection = array();

        foreach ($dates as $date) {
            if(in_array(Carbon::parse($date)->dayOfWeek, $peakDays) && in_array(Carbon::parse($date)->dayOfWeek, $marketDays)){
                $collection[] = array('date' => $date, 'amount' => number_format($peakDaysRate));
            }
            else if(in_array(Carbon::parse($date)->dayOfWeek, $marketDays)){
                $collection[] = array('date' => $date, 'amount' => number_format($regularRate));
            }
        }

        return $collection;
    }

    private function dateStrToInt($str){
        if($str == "sun"){
          return 0;
        }
        else if($str == "mon"){
          return 1;
        }
        else if($str == "tue"){
          return 2;
        }
        else if($str == "wed"){
          return 3;
        }
        else if($str == "thur"){
          return 4;
        }
        else if($str == "fri"){
          return 5;
        }
        else if($str == "sat"){
          return 6;
        }
        else{
          return 7;
        }
    }

    public function checkPrevCollection($id){
        $lastCollect = DB::table('tblContractInfo as a')
        ->join('tblcollection as b','a.contractID','=','b.contractID')
        ->join('tblcollection_details as c','c.collectionID','=','b.collectionID')
        ->where('a.contractID',$id)
        ->select(DB::raw('MAX(collectDate) AS max')) 
        ->get()[0]->max;
    
        $date = date('Y/m/d H:i:s');
        $lastCollect = date('Y/m/d H:i:s',strtotime($lastCollect . "+1 days"));
        $period = new DatePeriod(
            new DateTime($lastCollect),
            new DateInterval('P1D'),
            new DateTime($date)
        );

        $array = array();
        foreach( $period as $date){ 
            $array[] = $date->format('Y-m-d');
        }
        
        try{
            DB::beginTransaction();

            foreach($array as $i)
            {   
                $newCollection = Collection::create([
                    'contractID' => $id
                ]);

                $newColDetails = CollectionDetails::create([
                    'collectionID' => $newCollection->collectionID,
                    'collectDate' => $i
                ]);
            }
            
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return response()->json(['error'=>$error]);
        }
    }

    public function makePayment($id){
        $lastCollect = $this::checkPrevCollection($id);
        $contract = Contract::find($id);
        $paymentLastID = Payment::whereRaw('paymentID = (select max(`paymentID`) from tblPayment)')->first();  
        $paymentLastID= count($paymentLastID) == 0 ? 1 : $paymentLastID->paymentID +1;
        $payID = 'PAYMENT-'.str_pad($paymentLastID, 5, '0', STR_PAD_LEFT);

        $unpaidCollections = DB::select("Select det.collectDate as collectDate, det.collectionID as collectionID,collect.contractID as contractID  FROM tblcollection_details as det LEFT JOIN tblpayment_collection as payment on payment.collectionDetID = det.collectionDetID LEFT JOIN tblcollection as collect on collect.collectionID = det.collectionID WHERE payment.collectionDetID IS NULL and det.collectDate <= NOW() and collect.contractID = '$id' ORDER BY collect.contractID");
        $dates =  array();

        foreach ($unpaidCollections as $i) {
            $dates[] = $i->collectDate;
        }

        $unpaidCollections = PaymentController::getRate($dates , $contract->StallRate->stallRateID);

        $checkadvance = DB::table('tblcollection_details as details')
        ->join('tblpayment_collection as payment','payment.collectionDetID','details.collectionDetID')
        ->join('tblcollection as collect','collect.collectionID','details.collectionID')
        ->where('collect.contractID','=',$id)
        ->orderBy('details.collectDate','desc')
        ->select('details.collectDate')
        ->max('details.collectDate');
                                // ->get();

        $dateFrom = count($checkadvance) > 0 ? Carbon::parse($checkadvance)->addDays(1)->format('Y-m-d') : Carbon::today()->addDays(1)->format('Y-m-d');
        if(count($unpaidCollections) > 0){
            $unpaid = 1;
        }
        else{
            $unpaid = 0;
        }

        return view('transaction/PaymentAndCollection/viewPayment',compact('contract','payID','unpaid','dateFrom','unpaidCollections','lastCollect'));
    }

    public function createBill(){
          return view('transaction/PaymentAndCollection/createBill');
    }

    public  function checkRecords(){
        $today = Carbon::today();
        $activeContracts = DB::table('tblContractInfo as a')
        ->where('a.contractStart','>=',$today->format('Y-m-d'))
        ->select('a.collectionType','a.contractID')
        ->get();

        foreach($activeContracts as $active){
            if($active->collectionType == 1){
                return $this->dailyBilling($active->contractID);
            }
        }	
    }

    public function dailyBilling($dailyBill){
        $getRate = DB::table('tblContractInfo as a')
        ->rightJoin('tblstallrate as b','a.stallRateID','=','b.stallRateID')
        ->where('a.contractID',$dailyBill)
        ->select('b.dblRate','b.dblPeakRate','b.peakRateType') 
        ->get();

        $getPeakDays = DB::table('tblUtilities as a')
        ->where('utilitiesID','2') 
        ->select('utilitiesDesc')
        ->get();

        $getMarketDays = DB::table('tblUtilities as a')
        ->where('utilitiesID','1') 
        ->select('utilitiesDesc')
        ->get();

        $counter = 0;
        $dayOfWeek = Carbon::today()->dayOfWeek;
        $marketDays = []; 
        //dayOfWeek returns integer 0 if Sunday, and so on...

        // store yung marketDays as array
        foreach($getMarketDays as $getDays){   
            $marketDays = explode(",",$getDays->utilitiesDesc);
        }

        // check if $dayOfWeek == $marketDays[index] then 
        // check if nasa Peakrate bago iinsert sa tblBilling 
        // sorry, iwan muna kita :( 

        // Coleen, beginTransaction gamitin mo!!!
        /*
        $store = [];

        return Carbon::today()->dayOfWeek ." ". $marketDays[0];
        for($x = 0; $x<count($marketDays); $x++) 
        {

            if($marketDays[$x] == 1)
            {
                $store[$x] = "Mon";
            }
            else if($marketDays[$x] == 2)
            {
                $store[$x] = "Tues";
            }
            else if($marketDays[$x] == 3)
            {
                $store[$x] = "Wed";
            }
            else if($marketDays[$x] == 4)
            {
                $store[$x] = "Thurs";
            }
            else if($marketDays[$x] == 5)
            {
                $store[$x] = "Fri";
            }
            else if($marketDays[$x] == 6)
            {
                $store[$x] = "Sat";
            }
            else
            {
                 $store[$x] = "Sun";
            }


        }
        */ 

    }

    public function getBills(){
        $data = DB::select('Select a.stallRentalID as stallRentalID, CONCAT_WS(" ",b.stallHFName, b.stallHMName, b.stallHLName) as stallHolderName, a.billID as billNo,a.billDateFrom as billFrom, a.billDateTo as billTo, date(a.created_at) as billDate, c.stallID as StallID, h.dblRate as rate from tblbilling_info a left JOIN tblstallrental_info c on(c.stallRentalID = a.stallRentalID) left JOIN  tblstallholder b on b.stallHID = c.stallHID LEFT JOIN  tblcontractinfo f on f.stallRentalID = c.stallRentalID LEFT JOIN tblstallrate g on g.stallRateID = f.stallRateID LEFT JOIN tblstallrate_details h on h.stallRateID = f.stallRateID');
        return response()->json($data);
    }

    public function getPaymentStatus(){
        $payments = Payment::all();

        $bills = Billing::with('Payment')
        ->whereNotIn('billID',$payments)->pluck('stallRentalID');

        $contractRate = Contract::where('stallRentalID','=',$bills)->get();
          //  return response()->json($contractRate);
    }

    public function viewHistory(Request $request){
        $id = $request->contractID;
    
        $recordCtr = 0; 
        $date = DB::select("select distinct paid.paidAmt as amt, payment.paymentID as paymentID, paid.paymentDate as paydate  from tblPayment_Collection as payment left JOIN tblCollection_Details as collectDet on collectDet.collectionDetID = payment.collectionDetID left join tblpayment as paid on paid.paymentID = payment.paymentID left JOIN tblcollection as collection on collection.collectionID = collectDet.collectionID where collection.contractID = '$id' order by paydate");
        $paymentID = array();
        $ctr =0;
        foreach($date as $date){   
            $date     = get_object_vars($date);
            $paymentID[$ctr]["paymentID"] = $date['paymentID'];
            $ctr++;
        }

        $ctr = 0;
        foreach($paymentID as $payID){
            $collectDates[$ctr]["date"] = Payment_Collection::with('CollectionDetails')
                ->where('paymentID',$payID['paymentID'])
                ->pluck('collectionDetID');

                $array = [];
                if(count($collectDates[$ctr]["date"])>1){
                    foreach($collectDates[$ctr]["date"] as $dates){
                        $array[]= CollectionDetails::where('collectionDetID',$dates)->pluck("collectDate");
                    }
                    $collectDates[$ctr]['date'] = $array;

                    
               }
                else{ 
                    $collectDates[$ctr]['date'] =  CollectionDetails::where('collectionDetID',$collectDates[$ctr]['date'])->pluck("collectDate");
               }

            $ctr++;
        }

        $date = DB::select("select distinct paid.paidAmt as amt, payment.paymentID as paymentID, paid.paymentDate as paydate  from tblPayment_Collection as payment left JOIN tblCollection_Details as collectDet on collectDet.collectionDetID = payment.collectionDetID left join tblpayment as paid on paid.paymentID = payment.paymentID left JOIN tblcollection as collection on collection.collectionID = collectDet.collectionID where collection.contractID = '$id' order by paydate");
        $initialFee = DB::select("select distinct payment.paymentID as paymentID,payment.paymentDate as payDate,(SELECT SUM(fees.initAmt) from tblinitialfees as fees) as totalAmt from tblpayment as payment left join tblinitial_details as details on details.paymentID = payment.paymentID LEFT JOIN tblinitialfees as fees on fees.initID =  details.initID where details.contractID = '$id' ");
        $charge = DB::select("select payment.paymentDate as payDate, charge.chargeName as chargeName, charge.chargeAmount as chargeAmount, details.paymentID as paymentID from tblpayment as payment left join tblcharge_details as details on details.paymentID = payment.paymentID LEFT JOIN tblcharges as charge on charge.chargeID =  details.chargeID where details.contractID = '$id' ");
        $utilities = DB::select("select payment.paymentDate as payDate,payment.paymentID as paymentID, payment.paidAmt as paidAmt from tblpayment as payment left join tblbilling_details as details on details.paymentID = payment.paymentID LEFT JOIN tblstallutilities_meterid as utilities on utilities.stallMeterID =  details.stallMeterID where utilities.contractID = '$id' ");
        $ctr = 0;

        if(count($date) > 0){
            foreach($date as $date){      
                $date = get_object_vars($date);
                $data[$recordCtr]["paymentID"] = 'PAYMENT-'.str_pad($date["paymentID"], 5, '0', STR_PAD_LEFT);
                $data[$recordCtr]["paidDate"] = $date['paydate'];
                $data[$recordCtr]["paidAmt"] = 'Php ' .number_format($date['amt'],2);
                if(count($collectDates[$ctr]['date'])>1){
                 $string = implode(',', $collectDates[$ctr]['date']);
                 $string = str_replace(array( '["', '"]' ), '', $string);
                }
                else{ $string = $collectDates[$ctr]['date'];
                $string = str_replace(array( '["', '"]' ), '', $string);}
                $data[$recordCtr]["description"] = 'Rental for '. $string;


                $recordCtr++;
                $ctr++;

            }
        }

        if(count($initialFee) > 0){
            foreach($initialFee as $initialFee){
                  $initialFee     = get_object_vars($initialFee);
                  $data[$recordCtr]["paymentID"] = 'PAYMENT-'.str_pad($initialFee["paymentID"], 5, '0', STR_PAD_LEFT);;
                  $data[$recordCtr]["paidDate"] = $initialFee["payDate"];
                  
                  $data[$recordCtr]["paidAmt"] = 'Php '.number_format($initialFee['totalAmt'],2);
                  $data[$recordCtr]["description"] = "Initial Fees";

                  $recordCtr++;
        }

        }
        if(count($charge) > 0){
            foreach($charge as $charges){
                $charges     = get_object_vars($charges);
                $data[$recordCtr]["paymentID"] = 'PAYMENT-'.str_pad($charges["paymentID"], 5, '0', STR_PAD_LEFT);;
                $data[$recordCtr]["paidDate"] = $charges["payDate"];
                  
                $data[$recordCtr]["paidAmt"] = 'Php '.number_format($charges['chargeAmount'],2);
                $data[$recordCtr]["description"] = "Payment for " .$charges['chargeName'];
        }
            $recordCtr++;
        }
        if(count($utilities)>0){
            foreach($utilities as $utilities){
                $utilities     = get_object_vars($utilities);
                $data[$recordCtr]["paymentID"] = 'PAYMENT-'.str_pad($utilities["paymentID"], 5, '0', STR_PAD_LEFT);
                $data[$recordCtr]["paidDate"] = $utilities["payDate"];
                  
                $data[$recordCtr]["paidAmt"] = 'Php '.number_format($utilities['paidAmt'],2);
                $data[$recordCtr]["description"] = "Payment for Utilities";
            }
            $recordCtr++;
        }

        
        

        return $data;  
    }

    public function generateBill($id){
        $billID = 'BILL'.str_pad($id, 5, '0', STR_PAD_LEFT); 
        $billing = Billing::where('billID','=',$id)->first();
        $contract = Contract::where('stallRentalID','=',$billing->stallRentalID)->get();

        $pdf = PDF::loadview('transaction.PaymentAndCollection.bill',compact('billing','contract','billID'))->setPaper([0,0,612,396]);

        return $pdf->stream('bill.pdf');
     //   return view('transaction.PaymentAndCollection.bill',compact('billID','billing','contract'));
    }
}
