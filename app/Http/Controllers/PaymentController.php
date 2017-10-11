<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use App\Billing;
use App\Payment;
use App\StallHolder;
use App\StallRate;
use App\Utilities;
use App\Collection;
use App\CollectionDetails;
use App\Payment_Collection;
use App\Charge_Details;
use App\Billing_Details;
use App\InitFeeDetail;
use App\Charges;
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
         if(count($unpaidCollections) > 0)
        {
        $unpaidCollections = PaymentController::getRate($dates , $contract->StallRate->stallRateID);
        }

        $checkadvance = DB::table('tblcollection_details as details')
        ->join('tblpayment_collection as payment','payment.collectionDetID','details.collectionDetID')
        ->join('tblcollection as collect','collect.collectionID','details.collectionID')
        ->where('collect.contractID','=',$id)
        ->orderBy('details.collectDate','desc')
        ->select('details.collectDate')
        ->max('details.collectDate');
                                // ->get();

        $dateFrom = count($checkadvance) > 0 ? Carbon::parse($checkadvance)->addDays(1)->format('Y-m-d') : Carbon::today()->addDays(1)->format('Y-m-d');
       
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

         $array = [];
         $arrayDates= [];
         $arrayAmt = [];
         $arrayTransactionID = [];
         $arrayBalance = [];
         $collectDetID = [];
         $ctr=0;
         $data = [[]];
         $totalAmt = 0;

         $stallRateID = Contract::find($id)->first();
         $tenantPaymentIDs = DB::select("select distinct payment.paymentID as paymentID, payment.paymentDate as paidDate, payment.paidAmt as paidAmt, transactionDet.transactionID as transacID
                                        FROM tblpayment as payment 
                                        LEFT JOIN tblpayment_transaction as transactionDet on transactionDet.transactionID = payment.transactionID
                                        LEFT JOIN tblinitial_details as details on details.transactionID = transactionDet.transactionID
                                        LEFT JOIN tblinitialfees as fees on fees.initID =  details.initID 
                                        LEFT JOIN tblpayment_collection as payCollect on payCollect.transactionID = transactionDet.transactionID
                                        LEFT JOIN tblcollection_details as collectDet on collectDet.collectionDetID = payCollect.collectionDetID
                                        LEFT JOIN tblcollection as collection on collection.collectionID = collectDet.collectionID 
                                        LEFT JOIN tblbilling_details as billdetails on billdetails.transactionID = transactionDet.transactionID
                                        LEFT JOIN tblstallutilities_meterid as utilities on utilities.stallMeterID =  billdetails.stallMeterID
                                        WHERE details.contractID = '$id' or collection.contractID = '$id' or utilities.contractID = '$id'");
       
        

       foreach($tenantPaymentIDs as $tenantPaymentIDs){
         $array[]= $tenantPaymentIDs->paymentID;
         $arrayDates[] =  Carbon::parse($tenantPaymentIDs->paidDate)->format('F d,Y');   
         $arrayAmt[] = $tenantPaymentIDs->paidAmt;
         $arrayTransactionID[] = $tenantPaymentIDs->transacID;
        }

        $ctr = 0;
        foreach($arrayTransactionID  as $transacID){

            $total = PaymentController::getTotalAmt($transacID);
            $arrayTotalAmt[$ctr] = $total;
            $ctr++;

          
        }
        // return $arrayTotalAmt;

        $size = count($array);
        $ctr = 0;
        while($ctr < $size)
        {   
             $data[$ctr]["paymentID"] = 'PAYMENT-'.str_pad($array[$ctr], 5, '0', STR_PAD_LEFT);
             $data[$ctr]["paymentDate"] =$arrayDates[$ctr];
             $data[$ctr]["totalAmt"] ='Php ' .number_format($arrayAmt[$ctr],2);
             $data[$ctr]["balance"] = 'Php ' .number_format(($arrayTotalAmt[$ctr] - $arrayAmt[$ctr]),2);
             $data[$ctr]['actions'] = "<button  value = '".$array[$ctr]."' onclick = 'return getDetails(this.value);' class='btn btn-primary'><span class = 'fa fa-eye'></span></button>  <button  value = '".$array[$ctr]."' onclick = '' class='btn btn-success'><span class = 'fa fa-print'></span></button>";
            $ctr++;
          

        }

       

       
         return $data;
     
    }
    public function getPaymentDetails(Request $request){
        $paymentID = $request->paymentID;
        $data =[[]];
        $recordCtr = 0;
        $transactionID = Payment::select('transactionID')
        ->where('paymentID',$paymentID)->get();

     foreach($transactionID as $transactionID)
     {
        // $transactionID = get_object_vars($transactionID);
        $collectedDates = DB::select("select  collectDet.collectDate as date,collection.contractID as contractID
                            from tblPayment_Collection as payment 
                            left JOIN tblCollection_Details as collectDet on collectDet.collectionDetID = payment.collectionDetID 
                            left JOIN tblcollection as collection on collection.collectionID = collectDet.collectionID
                            where payment.transactionID = '$transactionID->transactionID'
                            order by collectDet.collectDate");
    if(count($collectedDates) > 0){
        foreach($collectedDates as $date){
            $date = get_object_vars($date);
            $dates[] = $date['date'];
            $contractID = $date['contractID'];
        }
        if(count($dates)>0){
            $stallRateID = Contract::where('contractID',$contractID)->pluck('stallRateID')->first();
            
            $amt = PaymentController::getRate($dates,$stallRateID);
            foreach($amt as $amt){
               
                $data[$recordCtr]['description'] = "Rental Fee for " .Carbon::parse($amt['date'])->format("l")."( ". Carbon::parse($amt['date'])->format('F d,Y')." )";
                $data[$recordCtr]['amount'] = number_format($amt['amount'],2);
                $recordCtr++;
            }
        }
    }
        $chargeAmount = Charge_Details::where('transactionID',$transactionID->transactionID)->get();
       if(count($chargeAmount)>0){
        foreach ($chargeAmount as $amt) {
            $data[$recordCtr]['description'] = $amt->Charges->chargeName;
            $data[$recordCtr]['amount'] = number_format($amt->Charges->chargeAmount,2);
            $recordCtr++;
        }
       }

       $utilitiesAmt = Billing_Details::where('transactionID',$transactionID->transactionID)->get();
       if(count($utilitiesAmt)>0){
        foreach ($utilitiesAmt as $amt) {
            $data[$recordCtr]['description'] = "Utility Fee";
            $data[$recordCtr]['amount'] = number_format($amt->StallMeter->utilityAmt,2);
            $recordCtr++;
        }
       }

       $initAmt = InitFeeDetail::where('transactionID',$transactionID->transactionID)->get();
       if(count($initAmt)>0){
        foreach ($initAmt as $amt) {
            $data[$recordCtr]['description'] = $amt->InitialFee->initDesc;
            $data[$recordCtr]['amount'] = number_format($amt->InitialFee->initAmt,2);
            $recordCtr++;
        }

       }
   }
       return $data;

    }

    public function getTotalAmt($transactionID){
        $total = 0;
        $id = $transactionID;
        $dates =[];

        $collectDates = DB::select("select collect.collectDate as date from tblcollection_details as collect 
                        LEFT JOIN tblpayment_collection as payCollect on payCollect.collectionDetID = collect.collectionDetID
                        LEFT JOIN tblpayment_transaction as payTrans on payTrans.transactionID = payCollect.transactionID 
                        LEFT JOIN tblpayment as paid on paid.transactionID = payTrans.transactionID
                        where paid.transactionID = '$id'");
        foreach($collectDates as $date){

             $date = get_object_vars($date);
             $dates[] = $date['date'];

        }

        if(count($dates)>0){
            $collectionDetID = Payment_Collection::where('transactionID',$id)->pluck('collectionDetID')->first();
            $stallRateID = CollectionDetails::find($collectionDetID);

            $returnedAmt = PaymentController::getRate($dates,$stallRateID->Collection->Contract->stallRateID);
            if(count($returnedAmt) > 0){
                foreach($returnedAmt as $amt){
                    $total += $amt['amount'];
                }
            }
        }

        $chargeAmount = Charge_Details::where('transactionID',$transactionID)->get();
        if(count($chargeAmount)>0){
            foreach ($chargeAmount as $amt) {
                $total += $amt->Charges->chargeAmount;
            }
        }

        $utilitiesAmt = Billing_Details::where('transactionID',$transactionID)->get();
        if(count($utilitiesAmt)>0){
            foreach ($utilitiesAmt as $amt) {
                $total += $amt->StallMeter->utilityAmt;
            }
        }

        $initAmt = InitFeeDetail::where('transactionID',$transactionID)->get();
        if(count($initAmt)>0){
            foreach ($initAmt as $amt) {
                $total += $amt->InitialFee->initAmt;
            }
        }

        return $total;
    }

    public function printReceipt($id){

        return view('pdf/rentReceipt');
    }

    public function generateBill($id){
        $billID = 'BILL'.str_pad($id, 5, '0', STR_PAD_LEFT); 
        $billing = Billing::where('billID','=',$id)->first();
        $contract = Contract::where('stallRentalID','=',$billing->stallRentalID)->get();

        $pdf = PDF::loadview('transaction.PaymentAndCollection.bill',compact('billing','contract','billID'))->setPaper([0,0,612,396]);

        return $pdf->stream('bill.pdf');
    }
}
