<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ManageContractsController extends Controller
{
    //'

	public function stallListIndex()
	{

		return view('transaction/ManageContracts/MappingTable');
	}

	public function getStallList()
	{       

			$data = DB::select('Select a.stallID as stallID, b.floorID as floorID, c.bldgName as bldgName, f.stypeName as stypeName, a.stallStatus as stallStatus,  e.stypeArea as stypeArea from tblstall a join tblfloor b join tblbuilding c join tblstalltype_stallsize d join tblstalltype_size e join tblstalltype f where a.floorID = b.floorID and b.bldgID = c.bldgID and a.stype_SizeID = d.stype_SizeID and e.stypeSizeID = d.stypeSizeID and d.stypeID = f.stypeID');
				//whereIn 
			
    		return response()->json($data);
    }
    
    public function updateRegistration()
    {
    	return view('transaction/ManageContracts/updateRegistration');
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
