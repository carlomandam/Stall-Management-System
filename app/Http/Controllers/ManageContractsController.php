<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\StallRental;
use App\StallHolder;
use App\Stall;
use App\ContactNo;
use App\Product;
class ManageContractsController extends Controller
{
    //'
    public function getAvailableStalls(){
        $stalls = Stall::with('Floor.Building')->withCount('Pending')->has('StallType.StallRate')->doesntHave('CurrentTennant')->get();
        $data = array();
        foreach ($stalls as $stall) {
            $data['data'][] = $stall;
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
    
    public function getStallHolders(){
        $stalls = StallHolder::with('ActiveStallRental.Contract')->has('ActiveStallRental.Contract')->get();
        $data = array();
        
        foreach ($stalls as $stall) {
            $data['data'][] = $stall;
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

    public function getTennant($tennantid){
        $tennant = StallHolder::with('ContactNo')->where('stallHID',$tennantid)->first();
        
        if($tennant == null)
            return redirect('/StallHolderList');
        else
            return view('transaction.ManageContracts.Tennant_View',compact('tennant'));
    }

    public function updateTennant(){
        $change = 'false';
        $tennant = StallHolder::with('ContactNo')->where('stallHID',$_POST['tennant'])->first();
        
        $tennant->stallHFName = $_POST['fname'];
        $tennant->stallHMName = $_POST['mname'];
        $tennant->stallHLName = $_POST['lname'];
        $tennant->stallHAddress = $_POST['address'];
        $tennant->stallHSex = $_POST['sex'];
        $tennant->stallHBday = date_format(date_create($_POST['DOBYear'].'-'.$_POST['DOBMonth'].'-'.$_POST['DOBDay']),"Y-m-d");
        $tennant->stallHEmail = $_POST['email'];
            
            foreach($_POST['numbers'] as $no){
                $contact = ContactNo::where('contactNumber',$no)->first();
                if($no != '' && count($contact) == 0){
                    $contact = new ContactNo;
                    $contact->contactNumber = $no;
                    $contact->stallHID = $tennant->stallHID; 
                    $contact->save();

                    $change = 'true';
                }
            }

        if($tennant->isDirty()){
            $change = 'true';
            $tennant->save();
        }

        return $change;
    }

    public function deleteTennant(){
        $tennant = StallHolder::where('stallHID',$_POST['id'])->first();
        $tennant->delete();
    }

    public function getTennants(){
        $stalls = StallHolder::with('ContactNo')->get();
        $data = array();
        
        foreach ($stalls as $stall) {
            $stall['actions'] = "<a href='/getTennant/".$stall['stallHID']."'' class='btn btn-primary btn-flat'><span class='glyphicon glyphicon-pencil'></span>Update</a>
            
            <div class='btn-group'>
                <button type='button' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span> Deactivate</button>
                <ul class='dropdown-menu pull-right opensleft' role='menu'>
                    <center>
                        <h4>Are You Sure?</h4>
                        <li class='divider'></li>
                        <li><a href='#' onclick='deleteTennant(".$stall['stallHID'].");return false;'>YES</a></li>
                        <li><a href='#' onclick='return false'>NO</a></li>
                    </center>
                </ul>
            </div>";
            $data['data'][] = $stall;
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
    
    public function stallListIndex()
    {
        return view('transaction/ManageContracts/MappingTable');
    }
    function getStallInfo()
    {
        $stallrental = StallRental::where('stallRentalID',$_POST[''])->first();
        $stallHID = $stallrental->stallHID;
        $stallHolderDetails = StallHolder::where('stallHID',$stallHID)->first();
        $stallDetails = DB::table('tblStall')
            ->select('*')
            ->leftJoin('tblstalltype_stallsize as type','tblStall.stype_sizeID','=','type.stype_sizeID')
            ->leftJoin('tblstalltype as stype','type.stypeID','=','stype.stypeID')
            ->leftJoin('tblstalltype_size as size', 'type.stypeSizeID', '=', 'size.stypeSizeID')
            ->leftJoin('tblFloor as floor','tblStall.floorID','=','floor.floorID')
            ->leftJoin('tblBuilding as bldg','floor.bldgID','=','bldg.bldgID')
            ->where('tblStall.stallID',$stallrental->stallID)
            ->first();
        return view('transaction/ManageContracts/updateRegistration',compact('stallrental','stallHolderDetails','stallDetails'));   
    }
    
    function getRegistrationList()
    {
       
        $stalls = StallRental::with('StallHolder.ContactNo','Contract','Stall.StallType')->where('stallRentalStatus',2)->get();
        $data = array();
        
        foreach ($stalls as $stall) {
            $data['data'][] = $stall;
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
    
    public function getStallList()
    {       
            $data = DB::select('Select a.stallID as stallID, b.floorID as floorID, c.bldgName as bldgName, f.stypeName as stypeName, a.stallStatus as stallStatus,  e.stypeArea as stypeArea from tblstall a join tblfloor b join tblbuilding c join tblstalltype_stallsize d join tblstalltype_size e join tblstalltype f where a.floorID = b.floorID and b.bldgID = c.bldgID and a.stype_SizeID = d.stype_SizeID and e.stypeSizeID = d.stypeSizeID and d.stypeID = f.stypeID');
                //whereIn 
            
            return response()->json($data);
    }
    
    public function updateRegistration($rentID)
    {
        $prod = Product::all();
    	$stallrental = StallRental::with('Contract.StallRate','Product')->where('stallRentalID',$rentID)->first();
        if(count($stallrental) == 0)
            return redirect('/StallHolderList');
    	$stallHID = $stallrental->stallHID;
    	$stallHolderDetails = StallHolder::where('stallHID',$stallHID)->first();
        $contacts = ContactNo::where('stallHID',$stallHolderDetails->stallHID)->get();
    	$stallDetails = DB::table('tblStall')
            ->select('*')
            ->leftJoin('tblstalltype_stallsize as type','tblStall.stype_sizeID','=','type.stype_sizeID')
            ->leftJoin('tblstalltype as stype','type.stypeID','=','stype.stypeID')
            ->leftJoin('tblstalltype_size as size', 'type.stypeSizeID', '=', 'size.stypeSizeID')
            ->leftJoin('tblFloor as floor','tblStall.floorID','=','floor.floorID')
            ->leftJoin('tblBuilding as bldg','floor.bldgID','=','bldg.bldgID')
            ->where('tblStall.stallID',$stallrental->stallID)
            ->first();
        return view('transaction/ManageContracts/Application_View',compact('stallrental','stallHolderDetails','stallDetails','contacts','prod'));
    }
    public function regListIndex()
    {
        return view('transaction/ManageContracts/RegistrationList');
    }
    public function stallHListIndex()
    {
        return view('transaction/ManageContracts/StallHolderList');
    }
    public function contractListIndex()
    {
        return view('transaction/ManageContracts/ContractList');
    }
}