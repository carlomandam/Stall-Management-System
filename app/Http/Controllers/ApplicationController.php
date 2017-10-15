<?php

namespace App\Http\Controllers;
use App;
use DB;
use App\StallHolder;
use App\Stall;
use App\StallRate;
use App\StallType;
use App\ContactNo;
use App\Contract;
use App\Product;
use App\InitialFee;
use App\InitFeeDetail;
use App\Billing;
use App\Utilities;
use App\Payment;
use App\Requirements;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Redirector;

class ApplicationController extends Controller
{
    public function member(){
        return view ('transaction.Member');
    }

    public function stall(){
        return view ('transaction.Stalls');
    }

    public function Memview(){
        return view ('transaction.View');
    }

    public function Update(){
        return view ('transaction.Update');
    }

    public function create($stallid){ 
        $prod = Product::all();
        $req = Requirements::all();
        $stall = Stall::with('StallType.StallRate','StallType.StallType','StallType.StallTypeSize','Floor.Building')->doesntHave('CurrentTennant')->where('stallID',$stallid)->first();

        if($stall == null)
            return redirect('/StallHolderList');
        else
            return view('transaction.Application_temporary',compact('stall','prod','req'));
    }

    public function updateRegistration($ID){
        $prod = Product::all();
        $contract = Contract::find($ID);
        if(count($contract) == 0)
            return redirect('/StallHolderList');

        $stallHID = $contract->stallHID;
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
        ->where('tblStall.stallID',$contract->stallID)
        ->first();
        return view('transaction/ManageContracts/Application_View',compact('contract','stallHolderDetails','stallDetails','contacts','prod','req'));
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

            if(isset($_POST['req'])){
                foreach ($_POST['req'] as $req) {
                    $holder->Requirement()->attach($req);
                }
            }
        }
        $contract = Contract::where('stallHID',$holder->stallHID)->where('stallID',$_POST['stallid'])->get();
        if(count($contract) != 0)
            return 'exist';
        $contract = new Contract;
        $contract->stallID = $_POST['stallid'];
        $contract->stallHID = $holder->stallHID;
        $contract->orgName = $_POST['orgname'];
        $contract->businessName = $_POST['businessName'];
        $contract->stallRateID = $_POST['rateid'];
        $contract->save();

        if($contract->save()){
            foreach($_POST['products'] as $prod){
                $product = Product::where('productID',$prod)->where('productName',"!=",$prod)->first();
                if(count($product) == 0){
                    $product = new Product;
                    $product->productName = $prod;
                    if($product->save()){
                        $product->Contract()->attach($contract->contractID);
                    }
                }else
                    $product->Contract()->attach($contract->contractID);
            }

            return  "/UpdateRegistration/".$contract->contractID;
        }
    }

    function updateApplication(){
        $contract = Contract::find($_POST['contract']);
        $holder = $contract->StallHolder;
        $contract->businessName = $_POST['businessName'];
        $contract->orgName = $_POST['orgname'];
        if($contract->isDirty()){
            $contract->save();
        }

        if(isset($_POST['products'])){
            for($i = 0;$i < count($_POST['products']);$i++){
                if(!$contract->Product->contains($_POST['products'][$i])){
                    $product = Product::where('productID',$_POST['products'][$i])->orWhere('productName',"==",$_POST['products'][$i])->first();
                    if(count($product) == 0){
                        $product = new Product;
                        $product->productName =  $_POST['products'][$i];
                        if($product->save()){
                            $product->Contract()->attach($contract->contractID);
                        }
                    }
                    else
                        $product->Contract()->attach($contract->contractID);
                }
            }

            foreach ($contract->Product as $prod) {
                if(!in_array($prod->productID, $_POST['products'])){
                    $contract->Product()->detach($prod->productID);
                }
            }
        }else{
            foreach ($contract->Product as $prod) {
                $contract->Product()->detach($prod->productID);
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
        $holder->stallHBday = date("Y-m-d",strtotime($_POST['DOB']));
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

            if(isset($_POST['req'])){
                foreach ($_POST['req'] as $req) {
                    $holder->Requirement()->attach($req);
                }
            }
        }
        return $holder->stallHID;
    }

    function acceptRental(){
        $initFees = InitialFee::all();
        if(count($initFees) == 0)
            return "init";
        $contract = Contract::find($_POST['contract']);
        $rejects = Contract::where('stallID',$contract->stallID)->whereNull('prevContractID')->whereNull('contractStart')->whereNull('contractEnd')->where('contractID','!=',$_POST['contract'])->delete();

        foreach ($initFees as $init) {
            $check = InitFeeDetail::where('contractID',$contract->contractID)->get();
            $exist = array();
            
            foreach ($check as $c) {
                $exist[] = $c->initID;
            }

            if(!in_array($init->initID, $exist)){
                $ifd = new InitFeeDetail;
                $ifd->contractID = $contract->contractID;
                $ifd->initID = $init->initID;
                $ifd->save();
            }
        }

        return $contract->contractID;
    }

    function goToPayment($id){
        $contract = Contract::find($id);
        $paymentLastID = Payment::whereRaw('paymentID = (select max(`paymentID`) from tblPayment)')->first();  
        $paymentLastID= count($paymentLastID) == 0 ? 1 : $paymentLastID->paymentID +1;
        $payID = 'PAYMENT-'.str_pad($paymentLastID, 5, '0', STR_PAD_LEFT);
        $initFees = $contract->Initial_Details;
        
        return redirect("/ViewPayment/".$id);
    }

    function searchVendor(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = StallHolder::with('ContactNo')->where('stallHFName','LIKE',"%$search%")
            ->orWhere('stallHLName','LIKE',"%$search%")->get();
        }

        return response()->json($data);
    }

    function getVendorData(Request $request){
        $data = [];

        if($request->has('id')){
            $data = StallHolder::with('ContactNo')->find($request->id);
        }

        return response()->json($data);
    }

    function rejectRental(){
        $rental = StallRental::where('stallRentalID',$_POST['rental'])->first();
        $rental->stallRentalStatus = 3;
        $rental->save();
    }
}