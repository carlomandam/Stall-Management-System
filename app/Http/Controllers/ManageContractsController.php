<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\StallRental;
use App\StallHolder;
use App\Stall;
class ManageContractsController extends Controller
{
    //'
    public function getAvailableStalls(){
        $stalls = Stall::with('Floor.Building')->withCount('Pending')->has('StallType.StallRate.RateDetail')->doesntHave('CurrentTennant')->get();
        
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
    	$stallrental = StallRental::where('stallRentalID',$rentID)->first();
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
