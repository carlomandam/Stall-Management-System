<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contract;
use App\Building;
use App\StallRate;
use Carbon\Carbon;
class ReportController extends Controller
{
    function stallStatusIndex(){

    	$building = Building::all();
                 

         return view('/Reports/stallStatusReport',compact('building'));
    }

    function balanceSummaryIndex(){

        return view('/Reports/balanceSummary');
    }
    public function getBalanceSummary(){
         $totalUnpaid =[[]];
        $contractIDs = [];
        $dates = [];
        $recordCtr = 0;
        $stalls =DB::select("Select stallID as stallCode,CONCAT(stallH.stallHFName,' ',stallH.stallHLName) as tenantName, contractID as contractID from tblcontractInfo left join tblstallholder as stallH on stallH.stallHID = tblcontractInfo.stallHID where tblcontractInfo.deleted_at IS NULL && tblcontractInfo.contractEnd >= ".date("Y-m-d"));
   
        $collectionStat = DB::select("select collect, reminder,warning, tblutilities.lock as lockstat, terminate FROM `tblutilities` WHERE utilitiesID = 'util_collection_status'");


        foreach($stalls as $stall){
            $totalUnpaid[$recordCtr]['amount'] =  ReportController::computeUnpaid($stall->contractID);
            foreach($collectionStat as $stat){
                if($totalUnpaid[$recordCtr]['amount'] <= $stat->collect){
                    $totalUnpaid[$recordCtr]['stallID'] = $stall->stallCode;
                    $totalUnpaid[$recordCtr]['status'] = '<label class="label bg-primary">COLLECT</label>';
                    $totalUnpaid[$recordCtr]['name'] = $stall->tenantName;
                    $totalUnpaid[$recordCtr]['amount'] = number_format($totalUnpaid[$recordCtr]['amount'],2);
                }
                else if($totalUnpaid[$recordCtr]['amount'] <= $stat->reminder && $totalUnpaid[$recordCtr]['amount'] > $stat->collect){
                    $totalUnpaid[$recordCtr]['stallID'] = $stall->stallCode;
                    $totalUnpaid[$recordCtr]['status'] = '<span class="label bg-green"><label>REMINDER</label></span>';
                    $totalUnpaid[$recordCtr]['name'] = $stall->tenantName;
                    $totalUnpaid[$recordCtr]['amount'] = number_format($totalUnpaid[$recordCtr]['amount'],2);
                }
                else if($totalUnpaid[$recordCtr]['amount'] <= $stat->warning && $totalUnpaid[$recordCtr]['amount'] > $stat->reminder){
                    $totalUnpaid[$recordCtr]['stallID'] = $stall->stallCode;
                    $totalUnpaid[$recordCtr]['status'] = '<span class="label yellow"><label>WARNING</label></span>';
                    $totalUnpaid[$recordCtr]['name'] = $stall->tenantName;
                    $totalUnpaid[$recordCtr]['amount'] = number_format($totalUnpaid[$recordCtr]['amount'],2);
                }
                else if($totalUnpaid[$recordCtr]['amount'] <= $stat->lockstat && $totalUnpaid[$recordCtr]['amount'] > $stat->warning){
                    $totalUnpaid[$recordCtr]['stallID'] = $stall->stallCode;
                    $totalUnpaid[$recordCtr]['status'] = ' <span class="label bg-orange"><label>LOCK</label></span>';
                    $totalUnpaid[$recordCtr]['name'] = $stall->tenantName;
                    $totalUnpaid[$recordCtr]['amount'] = number_format($totalUnpaid[$recordCtr]['amount'],2);
                }
                else if($totalUnpaid[$recordCtr]['amount'] <= $stat->terminate && $totalUnpaid[$recordCtr]['amount'] > $stat->lockstat){
                    $totalUnpaid[$recordCtr]['stallID'] = $stall->stallCode;
                    $totalUnpaid[$recordCtr]['status'] = '<span class="label bg-red"><label>TERMINATE</label></span>';
                    $totalUnpaid[$recordCtr]['name'] = $stall->tenantName;
                    $totalUnpaid[$recordCtr]['amount'] = number_format($totalUnpaid[$recordCtr]['amount'],2);
                }
                else{
                    $totalUnpaid[$recordCtr]['status'] = 'Undefine';
                }
                // var_dump($totalUnpaid);
            }
            
            $recordCtr++;
        }

        return $totalUnpaid;
    }

    public function getStallStatus(Request $request){
            $totalUnpaid =[[]];
        $contractIDs = [];
        $stallStatus =[[]];
        $dates = [];
        $recordCtr =0;
        $collectCtr = 0;
        $collectAmt = 0;
        $reminderCtr = 0;
        $reminderAmt = 0;
        $warningCtr = 0;
        $warningAmt = 0;
        $lockCtr = 0;
        $lockAmt = 0;
        $terminateCtr = 0;
        $terminateAmt = 0;
        $vacantCtr =0;

        $bldgID = $request->bldgID;        

        $stalls =DB::select("Select stall.stallID as stallCode, contractID as contractID from tblcontractInfo as contract
            left JOIN tblstall as stall on stall.stallID = contract.stallID
            join tblfloor as floor on floor.floorID = stall.floorID
            JOIN tblbuilding as building on building.bldgID = floor.bldgID
            where contract.deleted_at IS NULL && contract.contractEnd >= curdate() && building.bldgID = '$bldgID'");
   
        $collectionStat = DB::select("select collect, reminder,warning, tblutilities.lock as lockstat, terminate FROM `tblutilities` WHERE utilitiesID = 'util_collection_status'");


        foreach($stalls as $stall){
            $totalUnpaid[$recordCtr]['amount'] =  ReportController::computeUnpaid($stall->contractID);
            foreach($collectionStat as $stat){
                if($totalUnpaid[$recordCtr]['amount'] <= $stat->collect){
                    // $totalUnpaid[$recordCtr]['status'] = 'COLLECT';
                    $collectCtr++;
                    $collectAmt += $totalUnpaid[$recordCtr]['amount'];
                }
                else if($totalUnpaid[$recordCtr]['amount'] <= $stat->reminder && $totalUnpaid[$recordCtr]['amount'] > $stat->collect){
                    // $totalUnpaid[$recordCtr]['status'] = 'REMINDER';
                    $reminderCtr++;
                    $reminderAmt += $totalUnpaid[$recordCtr]['amount'];
                }
                else if($totalUnpaid[$recordCtr]['amount'] <= $stat->warning && $totalUnpaid[$recordCtr]['amount'] > $stat->reminder){
                    // $totalUnpaid[$recordCtr]['status'] = 'WARNING';
                    $warningCtr++;
                    $warningAmt += $totalUnpaid[$recordCtr]['amount'];
                }
                else if($totalUnpaid[$recordCtr]['amount'] <= $stat->lockstat && $totalUnpaid[$recordCtr]['amount'] > $stat->warning){
                    // $totalUnpaid[$recordCtr]['status'] = 'LOCK';
                    $lockCtr++;
                    $lockAmt += $totalUnpaid[$recordCtr]['amount'];
                }
                else if($totalUnpaid[$recordCtr]['amount'] <= $stat->terminate && $totalUnpaid[$recordCtr]['amount'] > $stat->lockstat){
                    // $totalUnpaid[$recordCtr]['status'] = 'TERMINATE';
                     $terminateCtr++;
                    $terminateAmt += $totalUnpaid[$recordCtr]['amount'];
                }
                else{
                    // $totalUnpaid[$recordCtr]['status'] = 'Undefined';
                }
                // var_dump($totalUnpaid);
            }
            
            $recordCtr++;
        }

        for($i = 0; $i <= 6; $i++){

            if($i == 0){
                $stallStatus[$i]['status'] = '<label class="label bg-primary">COLLECT</label>';
                $stallStatus[$i]['count'] = $collectCtr;
                $stallStatus[$i]['amount'] = $collectAmt; 
            }
            else if($i == 1){
                $stallStatus[$i]['status'] = '<span class="label bg-green"><label>REMINDER</label></span>';
                $stallStatus[$i]['count'] = $reminderCtr;
                $stallStatus[$i]['amount'] = $reminderAmt; 
            }
            else if($i == 2){
                $stallStatus[$i]['status'] = '<span class="label yellow"><label>WARNING</label></span>';
                $stallStatus[$i]['count'] = $warningCtr;
                $stallStatus[$i]['amount'] = $warningAmt; 

            }
            else if($i == 3){
                $stallStatus[$i]['status'] = ' <span class="label bg-orange"><label>LOCK</label></span>';
                $stallStatus[$i]['count'] = $lockCtr;
                $stallStatus[$i]['amount'] = $lockAmt; 

            }
            else if($i ==4){
                $stallStatus[$i]['status'] = '<span class="label bg-red"><label>TERMINATE</label></span>';
                $stallStatus[$i]['count'] = $terminateCtr;
                $stallStatus[$i]['amount'] = $terminateAmt; 

            }
            else if($i == 5){
                $count = DB::select("Select( (Select count(stall.stallID) as contracts from tblstall as stall
            join tblfloor as floor on floor.floorID = stall.floorID
            JOIN tblbuilding as building on building.bldgID = floor.bldgID
            where building.bldgID = '$bldgID') - count(stall.stallID))as contracts from tblcontractInfo as contract
            left JOIN tblstall as stall on stall.stallID = contract.stallID
            join tblfloor as floor on floor.floorID = stall.floorID
            JOIN tblbuilding as building on building.bldgID = floor.bldgID
            where contract.deleted_at IS NULL && contract.contractEnd >= curdate() && building.bldgID = '$bldgID'");

                 $stallStatus[$i]['status'] = '<span class="label bg-maroon"><label>VACANT</label></span>';
                 foreach($count as $count){
                $stallStatus[$i]['count'] = $count->contracts;}
                $stallStatus[$i]['amount'] = 0; 

            }
            else{

            }
        }
        return $stallStatus;
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

            $totalAmt = ReportController::getHistRate($dates,$stallRateID->stallRateID);
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
        //$holidays = Holiday::all();

        for($ctr = 0; $ctr < count($peakDays); $ctr++){ 
              $peakDays[$ctr] = ReportController::dateStrToInt($peakDays[$ctr]);
        }

        for($ctr = 0; $ctr < count($marketDays); $ctr++){
              $marketDays[$ctr] = ReportController::dateStrToInt($marketDays[$ctr]);
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
    function getPayment(Request $request){
        $startdate = $request->startdate;
        $enddate = $request->enddate;
     
        $array=[];
        $data =[];
        $paid = DB::select("select distinct  payment.paymentID as paymentID, payment.paymentDate as paidDate,
                payment.paidAmt as paidAmt,  details.contractID as detID, collect.contractID as colID,  chargedet.contractID as chargeID, util.contractID as utilID
               
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
                WHERE payment.paymentDate BETWEEN '$startdate' and '$enddate'");


        foreach($paid as $paid){
            $array[]= $paid->paymentID;
            $arrayDates[] =  Carbon::parse($paid->paidDate)->format('F d,Y');   
            $arrayAmt[] = $paid->paidAmt;

            if(!is_null($paid->detID)) {
                    $arrayContractID[] = $paid->detID;
            }
           else if( !is_null($paid->colID))
           {
                $arrayContractID[] = $paid->colID;
           } 
           else if(!is_null($paid->chargeID))
           {
                $arrayContractID[] = $paid->chargeID;
           } 
           else if(!is_null($paid->utilID)){
                $arrayContractID[] = $paid->utilID;
           }
           else{

           }
            $ctr = 0;
           foreach($arrayContractID as $id)
           {
           $checkName[$ctr] = ReportController::getName($id);  
           $ctr++;
            } 
                
            
        }

      

        $size = count($array);
        $ctr = 0;

        while($ctr < $size){   
            $data[$ctr]["paymentID"] = 'PAYMENT-'.str_pad($array[$ctr], 5, '0', STR_PAD_LEFT);
            $data[$ctr]['tenantName'] = $checkName[$ctr];
            $data[$ctr]["paymentDate"] =$arrayDates[$ctr];
            $data[$ctr]["totalAmt"] =number_format($arrayAmt[$ctr],2);
            
            $ctr++;
          

        }
         return $data;


    }
    function getName($contractID){
        $name = DB::select("select concat(tblstallholder.stallHFName, ' ', tblstallholder.stallHMName,' ', tblstallholder.stallHLName) as tenantName
             from tblstallholder join tblcontractinfo as contract where  contract.contractID = '$contractID' and contract.stallHID = tblstallholder.stallHID");
        foreach($name as $name){
            $name = $name->tenantName;
        }
        return $name;
    }
    function revenueReportIndex(){

        return view('Reports/revenueReport');

    }

   

}
