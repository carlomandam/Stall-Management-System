<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class RegistrationListController extends Controller
{
    public function getRegistrationList()
	{       

			$data = DB::select('Select a.stallID as stallID, a.stallRentID as rentID, CONCAT_WS(" ",b.stallHFName, b.stallHMName, b.stallHLName) as stallHolderName, b.stallHAddress as Address , c.contactNumber as ContactNo ,DATE(a.created_at) as RegDate from tblstallrental_info a join tblstallholder b join tblcontactnos c join tblstallrental_contactnos d where b.stallHID = a.stallHID and a.stallRentID = d.stallRentID  and c.contactID = d.contactID and a.stallRentalStatus = 0');
				//whereIn 
			
    		return response()->json($data);
    }
}
