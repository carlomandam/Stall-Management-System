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
use PDF;
use DB;
use Dompdf\Dompdf;
class ContractController extends Controller
{
    public function index(){
          $contract_period = ContractPeriod::all();
          
        
            return view('transaction.Contracts',compact('contract_period'));
   
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

    function getRentInfo(){
     //   $rent = Rent::with('Vendor')->get();
           $rent = Rent::join('tblvendor','tblrent_info.venID','=','tblvendor.venID')
            ->get();
          
     //   $contract = ContractInfo::with('Contract','ContractPeriod')->get();
        $data = array();
      //  $contractData = array();
        foreach ($rent as $rent) {
            $rent['actions'] = "
                      <button class='btn btn-success' onclick='' value = '".$rent['rentID']."' target = '' data-target = '#newcontract' data-toggle='modal'><span class='glyphicon glyphicon-plus'></span> New</button>
            <button class='btn btn-primary' onclick = 'callRoute(this.value)'value = '".$rent['rentID']."' ><span class='glyphicon glyphicon-print'></span> Print</a>
 
          
             <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' disabled><span class=' glyphicon glyphicon-ban-circle'></span> Cancel</button>
           
            ";
            $data['data'][] = $rent;
        } 
    
        
        if(count($data) == 0){
            echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
            "aaData": []
            }';

            return;
        }
        
        else
            return (json_encode($data));
    }

    function printPdf()
    {  

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

        //$contractinfo = \DB::select("");
        if($util->isEmpty())
        {
            $util = "";
        }
        else
        {   
            $utilityNames = Utility::whereIn('utilID',$util)->get();
        }
      /* $contract = Contract::with('ContractInfo.ContractPeriod')
                ->where('rentID','=',$rentid)
                ->get();*/
       // view()->share('vendorData',$vendorData);
       
     /*       
       $pdf = new Dompdf();
       $pdf= PDF::loadView('transaction.pdfview',compact('vendorData','stall','stypeCollection','fees','util','utilityNames'));*/
      
     // return $pdf->stream();
        //return $pdf->stream('contract.pdf',array('Attachment'=>false));
     
   return view('transaction.pdfview',compact('vendorData','stall','stypeCollection','fees',
       'util','utilityNames'));
 //  return view($contractinfo);
    }

   
}

