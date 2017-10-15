<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRental;
use App\Billing;
use App\Billing_Details;
use App\BillDates;
use App\Contract;
use App\Charges;
use App\Charge_Details;
use App\UtilityMeterID;
use Carbon\Carbon;
use DB;

class BillingController extends Controller{

    public function index(){
      $stalls = Contract::with('PrevContract','Stall','StallHolder')->get();
    	return view('transaction/PaymentAndCollection/Billing.index',compact('stalls'));
    }

    public function viewBill(){
      $contract = Contract::with('BilledUtilities.Billing','Charges.Billing_Charges')->find($_GET['id']);
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
      $billID = Billing_Details::with("Billing")->findMany($billID);
		  return view('transaction/PaymentAndCollection/Billing.billList',compact('contract','billID'));    	
    }

    public function bill(){
		  return view('transaction/PaymentAndCollection/Billing.bill');    	
    }

    public function createBill(){
      $contract = Contract::with('UnbilledUtilities.MonthlyReading','StallHolder')->find($_GET['id']);
      $charges = Charges::all();
      $last = Billing::whereRaw('billID = (select max(`billID`) from tblBilling)')->first();
      $last = "09/11/2017";
      //$last = ($last != null) ? $last->billDateTo : null; 
      return view('transaction/PaymentAndCollection/Billing.createBill',compact('contract','charges','last'));
    }

    public function newBill(){
      try{
        DB::beginTransaction();
        $bill  = Billing::create([
            'billDateFrom' => date("Y-m-d",strtotime($_POST['dateFrom']))
            , 'billDateTo' => date("Y-m-d",strtotime($_POST['dateTo']))
            , 'billDueDate' => date("Y-m-d",strtotime($_POST['dateTo']." +10 days"))
        ]);
        DB::commit();

        DB::beginTransaction();
        $billDet  = Billing_Details::create([
            'billID' => $bill->billID
        ]);
        DB::commit();
          //return $lastCollect."else";
      }
      catch(\Exception $e){
          DB::rollback();
          $error = $e->getMessage();
          return response()->json(['error'=>$error]);
      }
      echo "bill ID: ".$bill->billID;
      echo "util: ";
      if(isset($_POST['util'] )){
        foreach ($_POST['util'] as $u) {
          $util = UtilityMeterID::find($u);
          $util->Billing()->attach($billDet->billDetID);
          echo $u." ";

        }
      }

      echo "Charge: ";

      if(isset($_POST['charge'])){
        foreach ($_POST['charge'] as $u) {
          try{
            DB::beginTransaction();
            $charge = Charges::find($u);
            $det = Charge_Details::create([
                'contractID' => ($_POST['contract'])
                , 'chargeID' => $u
            ]);
            $det->Billing_Charges()->attach($billDet->billDetID);
  
            DB::commit();
            echo $u." ";
              //return $lastCollect."else";
          }

          catch(\Exception $e){
              DB::rollback();
              $error = $e->getMessage();
              return response()->json(['error'=>$error]);
          }
        }
      }

      echo "newCharge: ";
      if(isset($_POST['newCharge'] )){
        foreach ($_POST['newCharge'] as $u) {
          try{
            $data = explode(":", $u);
            DB::beginTransaction();
            $newCharge  = Charge_Details::create([
                'contractID' => ($_POST['contract'])
                , 'chargeDesc' => $data[0]
                , 'chargeAmt' => str_replace("₱ ", '', $data[1]) 
            ]);
  
            DB::commit();
            $newCharge->Billing_Charges()->attach($billDet->billDetID);
          }
          catch(\Exception $e){
              DB::rollback();
              $error = $e->getMessage();
              return response()->json(['error'=>$error]);
          }
          echo $data[0].":".$data[1];
        }
      }
      return redirect("/ViewBill?id=".$_POST['contract']);
    }
}