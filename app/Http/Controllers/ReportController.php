<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contract;
use App\StallRate;
use Carbon\Carbon;
class ReportController extends Controller
{
    function stallStatusIndex(){

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
        $stalls =DB::select("Select stallID as stallCode, contractID as contractID from tblcontractInfo where tblcontractInfo.deleted_at IS NULL && tblcontractInfo.contractEnd >= curdate()");
   
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

        for($i = 0; $i <= 5; $i++){

        	if($i == 0){
        		$stallStatus[$i]['status'] = 'COLLECT';
        		$stallStatus[$i]['count'] = $collectCtr;
        		$stallStatus[$i]['amount'] = $collectAmt; 
        	}
        	else if($i == 1){
        		$stallStatus[$i]['status'] = 'REMINDER';
        		$stallStatus[$i]['count'] = $reminderCtr;
        		$stallStatus[$i]['amount'] = $reminderAmt; 
        	}
        	else if($i == 2){
        		$stallStatus[$i]['status'] = 'WARNING';
        		$stallStatus[$i]['count'] = $warningCtr;
        		$stallStatus[$i]['amount'] = $warningAmt; 

        	}
        	else if($i == 3){
        		$stallStatus[$i]['status'] = 'LOCK';
        		$stallStatus[$i]['count'] = $lockCtr;
        		$stallStatus[$i]['amount'] = $lockAmt; 

        	}
        	else if($i ==4){
        		$stallStatus[$i]['status'] = 'TERMINATE';
        		$stallStatus[$i]['count'] = $terminateCtr;
        		$stallStatus[$i]['amount'] = $terminateAmt; 

        	}
        	else{

       	}
        }
// return $stallStatus;
         return view('/Reports/stallStatusReport');
    }

    public function computeUnpaid($contractID){
        $totalUnpaidAmt = 0;
         $unpaidCollections = DB::select("Select det.collectDate as collectDate, det.collectionID as collectionID,collect.contractID as contractID  FROM tblcollection_details as det LEFT JOIN tblcollection as collect on collect.collectionID = det.collectionID WHERE NOT EXISTS( SELECT * FROM tblpayment_collection as payment WHERE payment.collectionDetID = det.collectionDetID) AND det.collectDate <= NOW() and collect.contractID = '$contractID' ORDER BY collect.contractID");
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



}
