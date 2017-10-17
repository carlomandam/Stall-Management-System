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
use App\Billing_Charges;
use App\Transaction;
use App\StallMeter;
use DateTime;
use PDF;
use PDFF;
use DB;
use DateTimeZone;
use Carbon\Carbon;
use DatePeriod;
use DateInterval;
class PaymentController extends Controller{
    public function getHistRate($dates,$rateID){
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

        $getHolidays = DB::select("select CONCAT(year(curdate()),'-',LPAD(holi.month,2,'00'),'-',LPAD(holi.day,2,'00')) as holidate, holi.Name as name from tblholiday as holi");
      if(count($getHolidays) > 0){

         foreach($getHolidays as $holi){
            $holi = get_object_vars($holi);
            $holidays[] = $holi['holidate'];
            $holinames[] = $holi['name'];
          }
      }
        for($ctr = 0; $ctr < count($peakDays); $ctr++){ 
              $peakDays[$ctr] = PaymentController::dateStrToInt($peakDays[$ctr]);
        }

        for($ctr = 0; $ctr < count($marketDays); $ctr++){
              $marketDays[$ctr] = PaymentController::dateStrToInt($marketDays[$ctr]);
        }

        $collection = array();

        foreach ($dates as $date) {
            if(in_array(Carbon::parse($date)->dayOfWeek, $peakDays) && in_array(Carbon::parse($date)->dayOfWeek, $marketDays) || in_array($date, $holidays)){
                $collection[] = array('date' => $date, 'amount' => number_format($peakDaysRate));
            }
            else if(in_array(Carbon::parse($date)->dayOfWeek, $marketDays)){
                $collection[] = array('date' => $date, 'amount' => number_format($regularRate));
            }
        }

        return $collection;
    }

    public function newPaymentTransaction(){
        $transaction = new Transaction;
        $transaction->transactionDate = date('Y-m-d');
        if($transaction->save()){
            if(isset($_POST['init'])){
                foreach ($_POST['init'] as $i) {
                    $init = InitFeeDetail::find($i);
                    $init->transactionID = $transaction->transactionID;
                    $contract = $init->Contract->contractID;
                    $init->save();
                }
                $contract = Contract::find($contract);
                $contract->contractStart = date('Y-m-d');
                $contract->contractEnd = date('Y-m-d',strtotime(date('Y-m-d') . "+1 year"));
                $contract->save();
                $rejects = Contract::where('stallID',$contract->stallID)->whereNull('prevContractID')->whereNull('contractStart')->whereNull('contractEnd')->where('contractID','!=',$_POST['contract'])->delete();
            }

            if(isset($_POST['unpaid'])){
                foreach ($_POST['unpaid'] as $i) {
                    $pc = new Payment_Collection;
                    $pc->transactionID = $transaction->transactionID;
                    $pc->collectionDetID = $i;
                    $pc->save();
                }
            }

            if(isset($_POST['bills'])){
                foreach ($_POST['bills'] as $i) {
                    $bill = Billing_Details::find($i);
                    $bill->transactionID = $transaction->transactionID;
                    $bill->save();
                }
            }
            $payment = new Payment;
            $payment->transactionID = $transaction->transactionID;
            $payment->paidAmt = floatval(str_replace(',', '', $_POST['amtReceived']));
            $payment->paymentDate = date('Y-m-d');
            if($payment->save()){
                $contract = Contract::find($_POST['contract']);
                if(isset($_POST['init'])){
                    $init = InitFeeDetail::findMany($_POST['init']);
                }

                if(isset($_POST['unpaid'])){
                    $pc = CollectionDetails::findMany($_POST['unpaid']);
                    $pc = PaymentController::getRate($pc , $contract->StallRate->stallRateID);
                }

                if(isset($_POST['bills'])){
                    $bill = Billing_Details::with("Billing")->findMany($_POST['bills']);
                }

                return view('transaction/PaymentAndCollection/PaymentSuccess',compact('bill','pc','init','contract'));
            }
        }
    }

    public function index(){
        $totalUnpaid =[[]];
        $contractIDs = [];
        $dates = [];
        $recordCtr = 0;
        $stalls =DB::select("Select stallID as stallCode,CONCAT(stallH.stallHFName,' ',stallH.stallHLName) as tenantName, contractID as contractID from tblcontractInfo left join tblstallholder as stallH on stallH.stallHID = tblcontractInfo.stallHID where tblcontractInfo.deleted_at IS NULL && tblcontractInfo.contractEnd >= ".date("Y-m-d"));
   
        $collectionStat = DB::select("select collect, reminder,warning, tblutilities.lock as lockstat, terminate FROM `tblutilities` WHERE utilitiesID = 'util_collection_status'");


        foreach($stalls as $stall){
            $this::checkPrevCollection($stall->contractID);
            $totalUnpaid[$recordCtr]['amount'] =  PaymentController::computeUnpaid($stall->contractID);
            if($totalUnpaid[$recordCtr]['amount'] == 0){
                $totalUnpaid[$recordCtr]['actions'] = $stall->contractID;
            }
            foreach($collectionStat as $stat){
                if($totalUnpaid[$recordCtr]['amount'] <= $stat->collect){
                    $totalUnpaid[$recordCtr]['status'] = 'COLLECT';
                }
                else if($totalUnpaid[$recordCtr]['amount'] <= $stat->reminder && $totalUnpaid[$recordCtr]['amount'] > $stat->collect){
                    $totalUnpaid[$recordCtr]['status'] = 'REMINDER';
                }
                else if($totalUnpaid[$recordCtr]['amount'] <= $stat->warning && $totalUnpaid[$recordCtr]['amount'] > $stat->reminder){
                    $totalUnpaid[$recordCtr]['status'] = 'WARNING';
                }
                else if($totalUnpaid[$recordCtr]['amount'] <= $stat->lockstat && $totalUnpaid[$recordCtr]['amount'] > $stat->warning){
                    $totalUnpaid[$recordCtr]['status'] = 'LOCK';
                }
                else if($totalUnpaid[$recordCtr]['amount'] <= $stat->terminate && $totalUnpaid[$recordCtr]['amount'] > $stat->lockstat){
                    $totalUnpaid[$recordCtr]['status'] = 'TERMINATE';
                }
                else{
                    $totalUnpaid[$recordCtr]['status'] = 'Undefine';
                }
                // var_dump($totalUnpaid);
            }
            
            $recordCtr++;
        }
            
           // return $totalUnpaid;
        return view('transaction/PaymentAndCollection/finalPayment',compact('collectionStat','stalls','totalUnpaid'));
    }
    public function computeUnpaid($contractID){
        $totalUnpaidAmt = 0;
        $unpaidCollections = DB::select("Select det.collectDate as collectDate, det.collectionID as collectionID,collect.contractID as contractID  FROM tblcollection_details as det LEFT JOIN tblcollection as collect on collect.collectionID = det.collectionID WHERE NOT EXISTS( SELECT * FROM tblpayment_collection as payment WHERE payment.collectionDetID = det.collectionDetID) AND det.collectDate <= NOW() and collect.contractID = '$contractID' ORDER BY collect.contractID");
        $dates = array();
        foreach($unpaidCollections as $unpaid){
            $dates[] = $unpaid->collectDate;
        }
        
        $stallRateID = Contract::select('stallRateID')->where('contractID',$contractID)->first();
           
        if(count($dates)>0){

            $totalAmt = PaymentController::getHistRate($dates,$stallRateID->stallRateID);
                foreach($totalAmt as $total){
                    $totalUnpaidAmt += $total['amount']; 
                }
        }

        $unpaidCharges = DB::select("select sum(chargeDet.chargeAmt) + sum(charge.chargeAmount) as totalAmt
                from tblcharge_details as chargeDet 
                LEFT JOIN tblbilling_charges as billcharge on billcharge.chargeDetID = chargeDet.chargeDetID
                LEFT JOIN tblbilling_details as billdet on billdet.billDetID = billcharge.billDetID
                LEFT JOIN tblcharges as charge on charge.chargeID = chargeDet.chargeID
                WHERE billdet.transactionID is null and  chargeDet.contractID = '$contractID'");
        if(count($unpaidCharges)>0){
            foreach($unpaidCharges as $unpaid){
                $totalUnpaidAmt+= $unpaid->totalAmt;
            }

        }

        $unpaidUtilities = DB::select("select sum(utility.utilityAmt) as totalAmt
            from tblstallutilities_meterid as utility 
            LEFT JOIN tblbilling_utilities as billutil on billutil.stallMeterID = utility.stallMeterID
            LEFT JOIN tblbilling_details as billdet on billdet.billDetID = billutil.billDetID
            WHERE billdet.transactionID IS NULL and utility.contractID = '$contractID'");

        if(count($unpaidUtilities)>0){
          foreach($unpaidUtilities as $unpaid){
                $totalUnpaidAmt+= $unpaid->totalAmt;
            }
        }

        return $totalUnpaidAmt;

            


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
            if(in_array(Carbon::parse($date->collectDate)->dayOfWeek, $peakDays) && in_array(Carbon::parse($date->collectDate)->dayOfWeek, $marketDays)){
                $collection[] = array('date' => $date->collectDate, 'amount' => number_format($peakDaysRate),'detID' => $date->detID);
            }
            else if(in_array(Carbon::parse($date->collectDate)->dayOfWeek, $marketDays)){
                $collection[] = array('date' => $date->collectDate, 'amount' => number_format($regularRate),'detID' => $date->detID);
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

        $getMarketDays = DB::table('tblUtilities as a')
        ->where('utilitiesID','util_market_days') 
        ->select('utilitiesDesc')
        ->get();

        $marketDays = explode(",",$getMarketDays[0]->utilitiesDesc);

        for($ctr = 0; $ctr < count($marketDays); $ctr++){
              $marketDays[$ctr] = PaymentController::dateStrToInt($marketDays[$ctr]);
        }


        if($lastCollect == null){
            try{
                DB::beginTransaction();
                $newCollection = Collection::create([
                    'contractID' => $id
                ]);

                $newColDetails = CollectionDetails::create([
                    'collectionID' => $newCollection->collectionID,
                    'collectDate' => date("Y-m-d")
                ]);
                
                DB::commit();
            }
            catch(\Exception $e){
                DB::rollback();
                $error = $e->getMessage();
                return response()->json(['error'=>$error]);
            }
        }else if($lastCollect != date("Y-m-d")){
            $lastCollect = date('Y/m/d H:i:s',strtotime($lastCollect."+1 days"));
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
                    if(in_array(Carbon::parse($i)->dayOfWeek, $marketDays)){
                        $newCollection = Collection::create([
                            'contractID' => $id
                        ]);
    
                        $newColDetails = CollectionDetails::create([
                            'collectionID' => $newCollection->collectionID,
                            'collectDate' => $i
                        ]);
                    }
                }
                
                DB::commit();

                //return $lastCollect."else";
            }
            catch(\Exception $e){
                DB::rollback();
                $error = $e->getMessage();
                return response()->json(['error'=>$error]);
            }
        }
    }

    public function makePayment($id){
        $contract = Contract::with('BilledUtilities.Billing','Charges.Billing_Charges')->find($id);
        $paymentLastID = Payment::whereRaw('paymentID = (select max(`paymentID`) from tblPayment)')->first();  
        $paymentLastID= count($paymentLastID) == 0 ? 1 : $paymentLastID->paymentID +1;
        $payID = 'PAYMENT-'.str_pad($paymentLastID, 5, '0', STR_PAD_LEFT);
        $dateFrom = date('Y-m-d +1 days');
        $unpaidCollections = null;
        $bills = null;

        if($contract->contractStart != null && $contract->contractEnd != null){
            $lastCollect = $this::checkPrevCollection($id);
            $unpaidCollections = DB::select("Select det.collectDate as collectDate, det.collectionDetID as detID, det.collectionID as collectionID,collect.contractID as contractID  FROM tblcollection_details as det LEFT JOIN tblcollection as collect on collect.collectionID = det.collectionID WHERE NOT EXISTS( SELECT * FROM tblpayment_collection as payment WHERE payment.collectionDetID = det.collectionDetID) AND det.collectDate <= NOW() and collect.contractID = '$id' ORDER BY det.collectDate ASC");
            $dates =  array();

            if(count($unpaidCollections) > 0){
                $unpaidCollections = PaymentController::getRate($unpaidCollections , $contract->StallRate->stallRateID);
            }

            $checkadvance = DB::table('tblcollection_details as details')
            ->join('tblpayment_collection as payment','payment.collectionDetID','details.collectionDetID')
            ->join('tblcollection as collect','collect.collectionID','details.collectionID')
            ->where('collect.contractID','=',$id)
            ->orderBy('details.collectDate','desc')
            ->select('details.collectDate')
            ->max('details.collectDate');

            $dateFrom = count($checkadvance) > 0 ? Carbon::parse($checkadvance)->addDays(1)->format('Y-m-d') : Carbon::today()->addDays(1)->format('Y-m-d');

            $totalUnpaid = PaymentController::computeUnpaid($id);
            $status = PaymentController::checkCollectStatus($totalUnpaid);
           
            $billID = array();
            foreach ($contract->BilledUtilities as $bill) {
                foreach ($bill->Billing as $id) {
                  if(!in_array($id->billID, $billID))
                    $billID[]=$id->billID; # code...
                }
            }
            foreach ($contract->Charges as $bill) {
                foreach ($bill->Billing_Charges as $id) {
                  if(!in_array($id->billID, $billID))
                    $billID[]=$id->billID; # code...
                }
            }
            $bills = Billing_Details::with("Billing")->whereNull("transactionID")->findMany($billID);
        }


        return view('transaction/PaymentAndCollection/viewPayment',compact('contract','payID','unpaid','dateFrom','unpaidCollections','lastCollect','dates','bills','totalUnpaid','status'));
    }
    public function checkCollectStatus($amount){
        $status = "";
        $collectionStat = DB::select("select collect, reminder,warning, tblutilities.lock as lockstat, terminate FROM `tblutilities` WHERE utilitiesID = 'util_collection_status'");
        foreach($collectionStat as $stat){
             if($amount <= $stat->collect){
                        $status  = 'COLLECT';
                    }
                    else if($amount <= $stat->reminder && $amount > $stat->collect){
                        $status  = 'REMINDER';
                    }
                    else if($amount <= $stat->warning && $amount > $stat->reminder){
                       $status  = 'WARNING';
                    }
                    else if($amount<= $stat->lockstat && $amount > $stat->warning){
                        $status  = 'LOCK';
                    }
                    else if($amount <= $stat->terminate && $amount > $stat->lockstat){
                       $status = 'TERMINATE';
                    }
                    else{
                       $status = 'Undefine';
                    }
            
        }
        return $status;
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
         $tenantPaymentIDs = DB::select("select distinct payment.paymentID as paymentID, payment.paymentDate as paidDate,
            payment.paidAmt as paidAmt, transactionDet.transactionID as transacID
            FROM tblpayment as payment 
            LEFT JOIN tblpayment_transaction as transactionDet on transactionDet.transactionID = payment.transactionID
            LEFT JOIN tblinitial_details as details on details.transactionID = transactionDet.transactionID
            LEFT JOIN tblpayment_collection as payCollect on payCollect.transactionID = transactionDet.transactionID
            LEFT JOIN tblcollection_details as collection on collection.collectionDetID = payCollect.collectionDetID
            LEFT JOIN tblcollection as collect on collect.collectionID = collection.collectionID
            LEFT JOIN tblbilling_details as billdetails on billdetails.transactionID = transactionDet.transactionID
            LEFT JOIN tblinitial_details as initdetails on initdetails.transactionID = transactionDet.transactionID
            LEFT JOIN tblbilling_charges as billcharge on billcharge.billDetID = billdetails.billDetID
            LEFT JOIN tblcharge_details as chargedet on chargedet.chargeDetID = billcharge.chargeDetID
            LEFT JOIN tblbilling_utilities as billutil on billutil.billDetID = billdetails.billDetID
            LEFT JOIN tblstallutilities_meterid as util on util.stallMeterID = billutil.stallMeterID
            WHERE details.contractID = '$id' or collect.contractID = '$id' or initdetails.contractID = '$id' or chargedet.contractID = '$id' 
            or util.contractID = '$id'");

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

        $size = count($array);
        $ctr = 0;

        while($ctr < $size){   
            $data[$ctr]["paymentID"] = 'PAYMENT-'.str_pad($array[$ctr], 5, '0', STR_PAD_LEFT);
            $data[$ctr]["paymentDate"] =$arrayDates[$ctr];
            $data[$ctr]["totalAmt"] ='Php ' .number_format($arrayAmt[$ctr],2);
            $data[$ctr]["balance"] = 'Php ' .number_format(($arrayTotalAmt[$ctr] - $arrayAmt[$ctr]),2);
            $data[$ctr]['actions'] = "<button  value = '".$array[$ctr]."' onclick = 'return getDetails(this.value);' class='btn btn-primary'><span class = 'fa fa-eye'></span></button>  <button  value = '".$array[$ctr]."' onclick = '' class='btn btn-success'><span class = 'fa fa-print'></span></button>";
            $ctr++;
          

        }
        if(count($data[0]) == 0){
            echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
            "aaData": []
            }';

            return;
        }else
        return $data;

    }

    public function getPaymentDetails(Request $request){
        $paymentID = $request->paymentID;
        $data =[[]];
        $recordCtr = 0;
        $transactionID = Payment::select('transactionID')
        ->where('paymentID',$paymentID)->get();
        $getHolidays = DB::select("select CONCAT(year(curdate()),'-',LPAD(holi.month,2,'00'),'-',LPAD(holi.day,2,'00')) as holidate, holi.Name as name from tblholiday as holi");
      if(count($getHolidays) > 0){

         foreach($getHolidays as $holi){
            $holi = get_object_vars($holi);
            $holidays[] = $holi['holidate'];
            $holinames[] = $holi['name'];
          }
      }

        foreach($transactionID as $transactionID){
            // $transactionID = get_object_vars($transactionID);
            $collectedDates = DB::select("select collectDet.collectDate as date,collection.contractID as contractID
                from tblPayment_Collection as payment 
                left JOIN tblCollection_Details as collectDet on collectDet.collectionDetID = payment.collectionDetID 
                left JOIN tblcollection as collection on collection.collectionID = collectDet.collectionID
                where payment.transactionID = '$transactionID->transactionID'
                ORDER BY collectDet.collectDate ASC");

            if(count($collectedDates) > 0){
                foreach($collectedDates as $date){
                    $date = get_object_vars($date);
                    $dates[] = $date['date'];
                    $contractID = $date['contractID'];
                }
                if(count($dates)>0){
                    $stallRateID = Contract::where('contractID',$contractID)->pluck('stallRateID')->first();
                    
                    $amt = PaymentController::getHistRate($dates,$stallRateID);
                    foreach($amt as $amt){
                        if(in_array($amt['date'], $holidays))
                        {
                         $key = array_search($amt['date'], $holidays);
                         $data[$recordCtr]['description'] = "Rental Fee for " .$holinames[$key]." Holiday ( ". Carbon::parse($amt['date'])->format('F d,Y') .")";
                        }
                        else{
                        $data[$recordCtr]['description'] = "Rental Fee for " .Carbon::parse($amt['date'])->format("l")."( ". Carbon::parse($amt['date'])->format('F d,Y')." )";}
                        $data[$recordCtr]['amount'] = number_format($amt['amount'],2);
                        $recordCtr++;
                    }
                }
            }

          $billDetID =   Billing_Details::where('transactionID',$transactionID->transactionID)->get();

            if(count($billDetID) > 0)
            {
                foreach ($billDetID as  $value) {
                              
                       if(count($value) > 0){
                            foreach($value->Billing_Utilities as $util)
                            {
                                 $utilamt = StallMeter::select('utilityAmt')->where('stallMeterID',$util->stallMeterID)->get();
                                    if(count($utilamt) > 0){
                                        foreach($utilamt as $utilamt){
                                            $data[$recordCtr]["description"] = "Utility Fee";
                                            $data[$recordCtr]["amount"] = number_format($utilamt->utilityAmt,2);
                                            $recordCtr++;
                                        }
                                    }                                
                            }
                            $charge = Billing_Charges::where('billDetID',$value->billDetID)->get();
                            foreach($charge as $charge){
                               
                                $chargeamt = Charge_Details::where('chargeDetID',$charge->chargeDetID)
                                            ->whereNotNull('chargeID')->get();
                                $modifyCharge = Charge_Details::where('chargeDetID',$charge->chargeDetID)
                                            ->whereNotNull('chargeAmt')->get();
                                            
                                          
                               if(count($chargeamt) > 0){
                                    foreach($chargeamt as $charge){
                                       $data[$recordCtr]['description'] = $charge->Charges->chargeName;
                                       $data[$recordCtr]['amount'] = number_format($charge->Charges->chargeAmount,2);
                                       $recordCtr++;
                                    }
                                }
                                if(count($modifyCharge) > 0){
                                    foreach($modifyCharge as $charge){
                                       $data[$recordCtr]['description'] = $charge->chargeDesc;
                                       $data[$recordCtr]['amount'] = number_format($charge->chargeAmt,2);
                                       $recordCtr++;
                                    }
                                }
                            }

                        }
                        
                 
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

            $returnedAmt = PaymentController::getHistRate($dates,$stallRateID->Collection->Contract->stallRateID);
            if(count($returnedAmt) > 0){
                foreach($returnedAmt as $amt){
                    $total += $amt['amount'];
                }
            }
        }

        /*$chargeAmount = Charge_Details::where('transactionID',$transactionID)->get();
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
        }*/

        $initAmt = InitFeeDetail::where('transactionID',$transactionID)->get();
        if(count($initAmt)>0){
            foreach ($initAmt as $amt) {
                $total += $amt->InitialFee->initAmt;
            }
        }

        return $total;
    }

    public function printReceipt(){

        return view('pdf/invoice');
    }

    public function generateBill($id){
        $billID = 'BILL'.str_pad($id, 5, '0', STR_PAD_LEFT); 
        $billing = Billing::where('billID','=',$id)->first();
        $contract = Contract::where('stallRentalID','=',$billing->stallRentalID)->get();

        $pdf = PDF::loadview('transaction.PaymentAndCollection.bill',compact('billing','contract','billID'))->setPaper([0,0,612,396]);

        return $pdf->stream('bill.pdf');
    }
}
