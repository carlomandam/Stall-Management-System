<?php

namespace App\Http\Controllers;
use App;
use DB;
use App\Vendor;
use App\Stall;
use App\StallRate;
use App\StallType;
use App\Rent;
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

     public function create()
     {  //GET NEXT STALL HOLDER ID///

        $nextId = "SH-" . date('Y'); 
         $def = DB::table('tblvendor')->max('venID')+1; 
        
        if($def == null || $def == 0)
        {
            $def = 1; //if there is no data in database
        }
        $nextId = $nextId. str_pad($def, 5, 0, STR_PAD_LEFT);
        //END OF GET NEXT STALL HOLDER ID///

        /// SELECT2 DROPDOWN POPULATE///

       
        $stallinRent = DB::table('tblrent_info')
                     ->pluck('stallID')->toArray();

         $stall = Stall::with('StallType','Floor.Building','StallUtil.Utility')
         ->whereNotIn('stallID',$stallinRent)->get();
        $buildingNames = DB::table('tblbuilding')->pluck('bldgName');
        $buildingNames = $buildingNames->toArray();
        $buildingCount = DB::table('tblbuilding')->count();
      
        //END OF SELECT2 DROPDWON//


       
         
        
        
        return view('transaction.Application_temporary',compact('nextId','stall','buildingNames','buildingCount'));
    }
 

    
    function addVendor()
    { 
      if(isset($_POST['ven_name']))
      {
        $vendor = Vendor::find($_POST['ven_name']);
         try{
                
          
                    $rent = new Rent;
                    $rent->stallID = $_POST['stallno_name'];
                    $rent->venID = $vendor->venID;
                    $rent->rentStartDate = $_POST['datepicker'];
                    $rent->rentRegDate = date('Y-m-d');
                    $rent->rentBusinessName = $_POST['businessName'];
                    $rent->rentProdDesc = $_POST['prods']; 
                    $rent->assocHolder_1 =$_POST['assoc_one'];
                    $rent->assocHolder_2 =$_POST['assoc_two'];
                    $rent->save();
                
            }catch(Exception $e)
            {
              $vendor->forceDelete();
            }
      }
      else{
        $vendor = new Vendor;

        $vendor->venFName = $_POST['fname'];
        $vendor->venMName = $_POST['mname'];
        $vendor->venLName =  $_POST['lname'];
        $vendor->venSex =  $_POST['sex'];
        $vendor->venAddress =  $_POST['address'];
        $vendor->venBday =  $_POST['DOBYear']."-". $_POST['DOBMonth']."-". $_POST['DOBDay'];
        $vendor->venContact = $_POST['mob'];
        $vendor->venEmail =  $_POST['email'];;

        if($vendor->save()){
            try{
                
          
                    $rent = new Rent;
                    $rent->stallID = $_POST['stallno_name'];
                    $rent->venID = $vendor->venID;
                    $rent->rentStartDate = $_POST['datepicker'];
                    $rent->rentRegDate = date('Y-m-d');
                    $rent->rentBusinessName = $_POST['businessName'];
                    $rent->rentProdDesc = $_POST['prods']; 
                    $rent->assocHolder_1 =$_POST['assoc_one'];
                    $rent->assocHolder_2 =$_POST['assoc_two'];
                    $rent->save();
                
            }catch(Exception $e)
            {
              $vendor->forceDelete();
            }
        }
      }
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

   

