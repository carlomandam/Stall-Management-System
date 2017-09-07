<?php

namespace App\Http\Controllers;
use App;
use DB;
use App\StallHolder;
use App\ContactNo;
use App\Stall;
use App\StalLRental;
use App\StallRate;
use App\StallType;
use App\Rent;
use App\ContactNos;
use App\ContractPeriod;
use App\Contract;
use App\Product;
use App\ContractInfo;
use App\InitFee;
use App\InitBill;
use App\Billing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Redirector;

class ApplicationController extends Controller
{
   


    public function view($stallid,$rentalid){
        $prod = Product::all();
        $stall = Stall::with('StallType.StallRate.RateDetail','StallType.StallType','StallType.StallTypeSize','Floor.Building')->doesntHave('CurrentTennant')->where('stallID',$stallid)->first();
        
        
        $rental =StallRental::with('StallHolder.ContactNo','Contract','Stall.StallType')->where('stallRentalID',$rentalid)->first();
        
        if($stall == null)
            return redirect('/StallHolderList');
        else
            return view('transaction.Application_temporary',compact('stall','rental','prod'));
    }
    
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
        $prod = Product::all();
        $stall = Stall::with('StallType.StallRate.RateDetail','StallType.StallType','StallType.StallTypeSize','Floor.Building')->doesntHave('CurrentTennant')->where('stallID',$stallid)->first();
            
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
        if($stall == null)
            return redirect('/StallHolderList');
        else
            return view('transaction.Application_temporary',compact('stall','prod')
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
                      $contact->stallRentalID = $rent->stallRentalID;
                      $contact->ContactNos()->attach($no);
                      
                    }

                     

                    if(isset($_POST['assoc_one']))
                    {
                      $stallholder = new StallHolder;
                      $stallholder->stallH_assocName = $_POST['assoc_one'];
                      $stallholder->save();

                      $stallholder->stallRentalID = $rent->stallRentalID;
                      $associd = $stallholder->stallH_assocID;
                      $stallholder->StallHolder()->attach($associd);
                    }
                    if(isset($_POST['assoc_two']))
                    {
                      $stallholder = new StallHolder;
                      $stallholder->stallH_assocName = $_POST['assoc_two'];
                      $stallholder->save();

                      $stallholder->stallRentalID = $rent->stallRentalID;
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
            $data = StallHolder::with('ContactNo')->where('stallHFName','LIKE',"%$search%")
                ->orWhere('stallHLName','LIKE',"%$search%")->get();
            /*$data = DB::table("tblstallholder")
                ->select("*",DB::raw("CONCAT(stallHFName,' ',stallHLName) as full_name"))
                ->where('stallHFName','LIKE',"%$search%")
                ->orWhere('stallHLName','LIKE',"%$search%")->join('tblContactNos','tblstallholder.stallHID','=','tblContactNos.stallHID')->groupBy('tblstallholder.stallHID')
                ->get();*/
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
    
    function newStallHolder(){
        $fname = trim(preg_replace('/\s\s+/',' ', str_replace("\n", " ", $_POST['fname'])));
        $mname = trim(preg_replace('/\s\s+/',' ', str_replace("\n", " ", $_POST['mname'])));
        $lname = trim(preg_replace('/\s\s+/',' ', str_replace("\n", " ", $_POST['lname'])));
        
        $check = StallHolder::where('stallHFName',$fname)->where('stallHMName',$mname)->where('stallHLName',$lname)->first();
        if(count($check) != 0)
            return $check->stallHID;
        $holder = new StallHolder;
        $holder->stallHFName = $fname;
        $holder->stallHMName = $mname;
        $holder->stallHLName = $lname;
        $holder->stallHBday = date_format(date_create($_POST['DOBYear'].'-'.$_POST['DOBMonth'].'-'.$_POST['DOBDay']),"Y-m-d");
        $holder->stallHEmail = $_POST['email'];
        $holder->stallHSex = $_POST['sex'];
        $holder->stallHAddress = $_POST['address'];
        if($holder->save()){
            foreach($_POST['numbers'] as $no){
                if($no != ''){
                    $contact = new ContactNo;
                    $contact->contactNumber = $no;
                    $contact->stallHID = $holder->stallHID; 
                    $contact->save();
                }
            }
        }
        return $holder->stallHID;
    }
    
    function acceptRental(){
        $bill = new Billing;
        $bill->billDateFrom = $date = date('Y-m-d');
        $bill->billDateTo = $date = date('Y-m-d');
        $bill->billDueDate = $date = date('Y-m-d');
        $bill->stallRentalID = $_POST['rental'];
        if($bill->save()){
            $initialFees = InitFee::all();
            foreach($initialFees as $fee){
                $fee->Billing()->attach($bill->billID);
            }
        }

        $rental = StallRental::where('stallRentalID',$_POST['rental'])->first();
        $rejects = StallRental::where('stallID',$rental->stallID)->where('stallRentalStatus',2)->where('stallRentalID','!=',$_POST['rental'])->get();
        
        foreach($rejects as $reject){
            $reject->stallRentalStatus = 3;
            $reject->save();
        }
        $rental->stallRentalStatus = 1;
        $rental->save();
    }
    
    function rejectRental(){
        $rental = StallRental::where('stallRentalID',$_POST['rental'])->first();
        $rental->stallRentalStatus = 3;
        $rental->save();
    }
    
    function newApplication(){
        if(!isset($_POST['ven_name'])){
            $holder = StallHolder::where('stallHID',$this->newStallHolder())->first();
        }else{
            $holder = StallHolder::where('stallHID',$_POST['ven_name'])->first();
            
            foreach($_POST['numbers'] as $no){
                $contact = ContactNo::where('contactNumber',$no)->first();
                if($no != '' && count($contact) == 0){
                    $contact = new ContactNo;
                    $contact->contactNumber = $no;
                    $contact->stallHID = $holder->stallHID; 
                    $contact->save();
                }
            }
        }
        $rental = StallRental::where('stallHID',$holder->stallHID)->where('stallID',$_POST['dispStallID'])->get();
        if(count($rental) != 0)
            return 'exist';
        $rental = new StallRental;
        $rental->stallID = $_POST['dispStallID'];
        $rental->stallHID = $holder->stallHID;
        $rental->orgName = $_POST['orgname'];
        $rental->businessName = $_POST['businessName'];
        $rental->startingDate = date_format(date_create($_POST['startDate']),"Y-m-d");
        $rental->stallRentalStatus = 2;
        
        if($rental->save()){
            $contract = new Contract;
            $contract->stallRentalID = $rental->stallRentalID;
            $contract->contractStart = date_format(date_create($_POST['startDate']),"Y-m-d");
            $contract->contractEnd = (isset($_POST['endDate'])) ? date_format(date_create($_POST['endDate']),"Y-m-d") : null;
            $contract->stallRateID = $_POST['rateid'];
            $contract->save();
            
            foreach($_POST['products'] as $prod){
                $product = Product::where('productID',$prod)->where('productName',"!=",$prod)->first();
                if(count($product) == 0){
                    $product = new Product;
                    $product->productName = $prod;
                    if($product->save()){
                        $product->StallRental()->attach($rental->stallRentalID);
                    }
                }
            }
        }
    }
    
    function updateApplication(){
        $rental = StallRental::with('Product')->where('stallRentalID',$_POST['rental'])->first();
        $contract = Contract::where('stallRentalID',$_POST['rental'])->first();
        
        $rental->businessName = $_POST['businessName'];
        $rental->orgName = $_POST['orgname'];
        $rental->startingDate = date_format(date_create($_POST['startdate']),"Y-m-d");
        if($rental->isDirty()){
            $rental->save();
        }
        
        $contract->contractStart = date_format(date_create($_POST['startdate']),"Y-m-d");
        $contract->contractEnd = date_format(date_create($_POST['enddate']),"Y-m-d");
        if($contract->isDirty()){
            $contract->save();
        }
        
        $existing = array();
        foreach($rental->Product as $prod){
            if(in_array($prod->productID,$_POST['products']))
                array_push($existing,$prod->productID);
            else
                $rental->Product()->detach($prod->productID);
        }
        
        for($i = 0;$i < count($_POST['products']);$i++){
            if(!in_array($_POST['products'][$i],$existing)){
                $product = Product::where('productID',$_POST['products'][$i])->where('productName',"!=",$prod)->first();
                if(count($product) == 0){
                    $product = new Product;
                    $product->productName =  $_POST['products'][$i];
                    if($product->save()){
                        $product->StallRental()->attach($rental->stallRentalID);
                    }
                }
                else
                    $product->StallRental()->attach($rental->stallRentalID);
            }
        }
    }
  }