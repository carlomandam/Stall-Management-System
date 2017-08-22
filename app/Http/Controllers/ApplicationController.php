<?php

namespace App\Http\Controllers;
use App;
use DB;
use App\StallHolder;
use App\Stall;
use App\StalLRental;
use App\StallRate;
use App\StallType;
use App\Rent;
use App\ContactNos;
use App\ContractPeriod;
use App\Contract;
use App\ContractInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ApplicationController extends Controller
{
   

    public function member()
    {

      return view ('transaction.Member');
    }

      public function stall()
    {

      return view ('transaction.Stalls');
    }
     public function Memview()
     {
      return view ('transaction.View');
     }
     public function Update()
     {
      return view ('transaction.Update');
     }

     public function create($stallid)
     { 
         
        $stall = Stall::with('StallType.StallRate.RateDetail','StallType.StallType','StallType.StallTypeSize','Floor.Building')->where('stallID',$stallid)->first();
            
            /*DB::table('tblStall')
            ->select('*')
            ->leftJoin('tblstalltype_stallsize as type','tblStall.stype_sizeID','=','type.stype_sizeID')
            ->leftJoin('tblstalltype as stype','type.stypeID','=','stype.stypeID')
            ->leftJoin('tblstalltype_size as size', 'type.stypeSizeID', '=', 'size.stypeSizeID')
            ->leftJoin('tblstallrate as rate', 'type.stype_SizeID', '=', 'rate.stype_SizeID')
            ->leftJoin('tblstallrate_details as detail', 'rate.stallRateID', '=', 'detail.stallRateID')
            ->leftJoin('tblFloor as floor','tblStall.floorID','=','floor.floorID')
            ->leftJoin('tblBuilding as bldg','floor.bldgID','=','bldg.bldgID')
            ->where('tblStall.stallID',$stallid)
            ->first();*/
        
         return view('transaction.Application_temporary',compact('stall')
                     /*,compact('nextId','stall','buildingNames','buildingCount','contract_period')*/);
    }
 

    
    function addVendor()
    { 
      /*if(isset($_POST['ven_name'])) //if search existing record
      {
        $vendor = Vendor::find($_POST['ven_name']);
     
        try{
                $input = Input::get('stallno_name');
                $count = count($input);
                  foreach($input as $Input)
                 {   $rent = new Rent;
                    $rent->stallID = $Input;
                    $rent->venID = $vendor->venID;
                    $date1 = $_POST['datepicker'];
                    $date1 = date('Y-m-d', strtotime($date1));
                    $rent->rentStartDate = $date1;
                    $rent->rentRegDate = date('Y-m-d');
                    $rent->rentBusinessName = $_POST['businessName'];
                    $rent->rentProdDesc = $_POST['prods']; 
                    $rent->assocHolder_1 =$_POST['assoc_one'];
                    $rent->assocHolder_2 =$_POST['assoc_two'];
                   


                    if( $rent->save())
                    {
                    

                      $contract = new Contract;
                      $contract->rentID = $rent->rentID;
                     
                      $contract->contractStatus = 0;

                      $contract->save();
                      if($contract->save())
                      { $periodID = $_POST['length'];
                        $length = (!isset($_POST['specific_no']) ? 1 : $_POST['specific_no']);
                            
                         
                        $contract->contractPeriods()->attach($periodID, ['contractLength' => $length ]);
                        
                      }
                      else
                      {
                        App::abort(500,"Error");
                      }
                    
                    }
                    else
                    {
                      App::abort(500,'Error');
                    }
               }
           
            }catch(Exception $e)
            {
              $vendor->forceDelete();
            }
      }
      else{*/
        $stallHolder = new StallHolder;

        $stallHolder->stallHFName = $_POST['fname'];
        $stallHolder->stallHMName = $_POST['mname'];
        $stallHolder->stallHLName =  $_POST['lname'];
        $stallHolder->stallHSex =  $_POST['sex'];
        $stallHolder->stallHAddress =  $_POST['address'];
        $stallHolder->stallHBday =  $_POST['DOBYear']."-". $_POST['DOBMonth']."-". $_POST['DOBDay'];
        $stallHolder->stallHEmail =  $_POST['email'];

        $savedStallHolder = $stallHolder->save();

        if($savedStallHolder){
            try{
               
                    $rent = new StallRental;
                    if(isset($_POST['dispStallID']))
                    {
                      $stallid = $_POST['dispStallID'];
                    
                    }
                    else{
                    $stallid = $_POST['dispStallID'];
                    $rent->stallID = $stallid;
                    $rent->stallHID = $stallHolder->stallHID;
                    $rent->orgName = $_POST['orgname'];
                    $date1 = $_POST['datepicker'];
                    $date1 = date('Y-m-d', strtotime($date1));
                    $rent->startingDate = $date1;
                    $rent->businessName = $_POST['businessName'];
                    $rent->stallRentalStatus = 0;
                    }
                    if( $rent->save())
                    {
                      
                     foreach($_POST['numbers'] as $no)
                     {
                      $contact = new ContactNos;
                      $contact->stallRentID = $rent->stallRentID;
                      $contact->ContactNos()->attach($no);
                      
                     }

                     

                    if(isset($_POST['assoc_one']))
                    {
                      $stallholder = new StallHolder;
                      $stallholder->stallH_assocName = $_POST['assoc_one'];
                      $stallholder->save();

                      $stallholder->stallRentID = $rent->stallRentID;
                      $associd = $stallholder->stallH_assocID;
                      $stallholder->StallHolder()->attach($associd);
                    }
                    if(isset($_POST['assoc_two']))
                    {
                      $stallholder = new StallHolder;
                      $stallholder->stallH_assocName = $_POST['assoc_two'];
                      $stallholder->save();

                      $stallholder->stallRentID = $rent->stallRentID;
                      $associd = $stallholder->stallH_assocID;
                      $stallholder->StallHolder()->attach($associd);
                    }

                    }
                    else
                    {
                      App::abort(500,'Error');
                    }
               
           
            }catch(Exception $e)
            {
              $vendor->forceDelete();
            }
        }
     
     // }
  

    }
function checkEmail()
{
    $vendor =  Vendor::where('venEmail',$_POST['email'])->get();
    if(count($vendor) != 0)
    
        return "false";
    
    else
    
        return "true";
}
 function getVendor(){

      $vendor = Vendor::all();
         //select venID, CONCAT name, actions//
      $data = array();
      foreach ($vendor as $ven) {
            $ven['actions'] = "
                    <button class='btn btn-primary'  data-toggle=
                  'modal' data-target='#update' onclick='getInfo(this.value)' value = '".$ven['venID']."' >Update</button>
                    <button class='btn btn-danger' data-toggle=
                  'modal' data-target='#delete'>Delete</button>
            ";
        $data['data'][] = $ven;
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
    function getVendorInfo()
    {
        $vendor = Vendor::where('venID',$_POST['id'])->get();
        return (json_encode($vendor));
    }

    function contractTable()
    {
      $rent = Rent::with('Vendor')->get();

    }

    function updateVendor()
    {
        $hasChange = false;
        $vendor =  Vendor::find($_POST['id']);
        $vendor->venOrgName = $_POST['orgname'];
        $vendor->venFName = $_POST['fname'];
        $vendor->venMName = $_POST['mname'];
        $vendor->venLName =  $_POST['lname'];
        $vendor->venSex =  $_POST['sex'];
        $vendor->venAddress =  $_POST['address'];
        $vendor->venBday =  $_POST['DOBYear']."-". $_POST['DOBMonth']."-". $_POST['DOBDay'];
        $vendor->venContact = $_POST['mob'];
        $vendor->venEmail =  $_POST['email'];;

           if($vendor->isDirty()){
            $vendor->save();
            $hasChange = true;
        }
             echo $hasChange;
    }

    function searchVendor(Request $request){
    $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("tblvendor")
                ->select("venID",DB::raw("CONCAT(venFName,' ',venLName) as full_name"))
                ->where('venFName','LIKE',"%$search%")
                ->orWhere('venLName','LIKE',"%$search%")
                ->get();
        }

        return response()->json($data);
  }

    function displaySearch()
    {
       $vendor = Vendor::where('venID',$_GET['id'])->get();
        return (json_encode($vendor));
    }


     public function pdfview(Request $request)
    {
        $items = DB::table("tblvendor")->get();
        view()->share('items',$items);

        if($request->has('download')){
            $pdf = PDF::loadView('pdfview');
            return $pdf->download('pdfview.pdf');
        }

        return view('pdfview');
    }

  }

   

