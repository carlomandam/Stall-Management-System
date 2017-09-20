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
use App\Utilities;
use App\Requirements;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Redirector;

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
        $prod = Product::all();
        $req = Requirements::all();
        $stall = Stall::with('StallType.StallRate','StallType.StallType','StallType.StallTypeSize','Floor.Building')->doesntHave('CurrentTennant')->where('stallID',$stallid)->first();

        if($stall == null)
            return redirect('/StallHolderList');
        else
            return view('transaction.Application_temporary',compact('stall','prod','req'));
    }
    
    public function updateRegistration($rentID)
    {
        $prod = Product::all();
        $stallrental = StallRental::with('Contract.StallRate','Product')->where('stallRentalID',$rentID)->first();
        if(count($stallrental) == 0)
            return redirect('/StallHolderList');
        $stallHID = $stallrental->stallHID;
        $stallHolderDetails = StallHolder::with('Requirement')->where('stallHID',$stallHID)->first();
        $contacts = ContactNo::where('stallHID',$stallHolderDetails->stallHID)->get();
        $req = Requirements::all();
        $stallDetails = DB::table('tblStall')
            ->select('*')
            ->leftJoin('tblstalltype_stallsize as type','tblStall.stype_sizeID','=','type.stype_sizeID')
            ->leftJoin('tblstalltype as stype','type.stypeID','=','stype.stypeID')
            ->leftJoin('tblstalltype_size as size', 'type.stypeSizeID', '=', 'size.stypeSizeID')
            ->leftJoin('tblFloor as floor','tblStall.floorID','=','floor.floorID')
            ->leftJoin('tblBuilding as bldg','floor.bldgID','=','bldg.bldgID')
            ->where('tblStall.stallID',$stallrental->stallID)
            ->first();
        return view('transaction/ManageContracts/Application_View',compact('stallrental','stallHolderDetails','stallDetails','contacts','prod','req'));
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
        $ven['actions'] = "<button class='btn btn-primary'  data-toggle='modal' data-target='#update' onclick='getInfo(this.value)' value = '".$ven['venID']."' >Update</button><button class='btn btn-danger' data-toggle='modal' data-target='#delete'>Delete</button>
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
    function getVendorInfo(){
        $vendor = Vendor::where('venID',$_POST['id'])->get();
        return (json_encode($vendor));
    }

    function contractTable(){
      $rent = Rent::with('Vendor')->get();

    }

    function updateVendor(){
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

    function displaySearch(){
       $vendor = Vendor::where('venID',$_GET['id'])->get();
        return (json_encode($vendor));
    }


    public function pdfview(Request $request){
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

            foreach ($_POST['req'] as $req) {
                $holder->Requirement()->attach($req)->withTimestamps();
            }
        }
        return $holder->stallHID;
    }
    
    function acceptRental(){
        $bill = new Billing;
        $bill->contractID = $_POST['contract'];
        $bill->billStatus = 1;
        if($bill->save()){
            $init = Utilities::where('utilitiesID','util_initial_fee')->first();
            $sec = new InitBill;
            $sec->billID = $bill->billID;
            $sec->initialType = 1;
            $sec->initialAmt = $init->secAmount;
            $sec->save();

            $main = new InitBill;
            $main->billID = $bill->billID;
            $main->initialType = 2;
            $main->initialAmt = $init->mainAmount;
            $main->save();
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

            foreach ($_POST['req'] as $req) {
                $holder->Requirement()->attach($req)->withTimestamps();
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
            $contract->collectionType = $_POST['collection'];
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
        $rental = StallRental::with('Product','StallHolder')->where('stallRentalID',$_POST['rental'])->first();
        $contract = Contract::where('stallRentalID',$_POST['rental'])->first();
        $holder = $rental->StallHolder;
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
        
        if(isset($_POST['products'])){
            for($i = 0;$i < count($_POST['products']);$i++){
                if(!$rental->Product->contains($_POST['products'][$i])){
                    $product = Product::where('productID',$_POST['products'][$i])->orWhere('productName',"==",$_POST['products'][$i])->first();
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

            foreach ($rental->Product as $prod) {
                if(!in_array($prod->prodID, $_POST['products'])){
                    $rental->Product()->detach($prod->prodID);
                }
            }
        }else{
            foreach ($rental->Product as $prod) {
                $rental->Product()->detach($prod->prodID);
            }
        }

        if(isset($_POST['req'])){
            foreach ($_POST['req'] as $req) {
                if(!$holder->Requirement->contains($req))
                    $holder->Requirement()->attach($req);
            }

            foreach ($holder->Requirement as $id) {
                if(!in_array($id->reqID, $_POST['req'])){
                    $holder->Requirement()->detach($id->reqID);
                }
            }
        }else{
            foreach ($holder->Requirement as $id) {
                $holder->Requirement()->detach($id->reqID);
            }
        }
    }
  }