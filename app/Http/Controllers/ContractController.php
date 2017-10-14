<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rent;
use App\Vendor;
use App\Contract;
use App\ContractInfo;
use App\ContractPeriod;
use App\Stall;
use App\StallType;
use App\StallRate;
use App\Penalty;
use App\Fee;
use App\StallUtil;
use App\Utility;
use App\Product;
use PDF;
use DB;
use Dompdf\Dompdf;
class ContractController extends Controller
{

public function index(){
    
    $contract_period = ContractPeriod::all();
    
    return view('transaction.Contracts',compact('contract_period'));
}

public function viewContract($id) {
    $contract = Contract::with('Stall','Product','StallRate')->find($id);
    $stall = Stall::with("Floor.Building","StallType.StallTypeSize","StallType.StallType")->find($contract->stallID);
    $prod = Product::all();
    $rates = StallRate::withTrashed()->where('stype_SizeID',$stall->stype_SizeID)->get();
    return view('Transaction.ManageContracts.ContractView',compact("contract","stall","prod","rates"));
}

public function ammend(){
  $old = Contract::find($_POST['id']);

  if(date_format(date_create($_POST['endDate']),"Y-m-d") == $old->contractEnd && $_POST['rate'] == $old->stallRateID)
    return 'same';
  
  $new = new Contract;

  $new->stallRentalID = $old->stallRentalID;

  $new->contractStart = date_format(date_create($old->contractStart),"Y-m-d");
  $new->contractEnd = (isset($_POST['endDate'])) ? date_format(date_create($_POST['endDate']),"Y-m-d") : null;
  $new->stallRateID = $_POST['rate'];
  $new->prevContractID = $old->contractID;

  if($new->save()){
      $old->delete();
      return $new->contractID;
  }
}

public function view(){
    return view('transaction.ViewContracts');
}
public function showdetails(){
    return view ('transaction.ShowDetails');
}

public function create()
{
    return view('transaction.CreateContract');
}

public function htmltopdfview($rentid)
{
  $vendorData = Rent::join('tblvendor','tblrent_info.venID' ,'=','tblvendor.venID')
  ->where('rentID','=',$rentid)->get();

  $pluckStallId = Rent::where('rentID','=',$rentid)
  ->pluck('stallID')
  ->first();
  $stall = Stall::with('Floor.Building')
  ->where('stallID','=',$pluckStallId)
  ->first();

  $stypeid = Stall::where('stallID','=',$pluckStallId)
  ->pluck('stypeID')->first();

  $stypeCollection= StallRate::where('stypeID','=',$stypeid)
  ->first();

  $fees = Penalty::all();

  $util = StallUtil::where('stallID','=',$pluckStallId)
  ->select('utilID','RateType','Rate','meterID')->get();

  if($util->isEmpty())
  {
    $util = "";
  }
  else
  {   
    $utilityNames = Utility::whereIn('utilID',$util)->get();
  }
  return view('transaction.pdfview',compact('vendorData','stall','stypeCollection','fees',
   'util','utilityNames'));
}

}

