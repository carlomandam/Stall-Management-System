<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class QueriesController extends Controller
{
    public function index()
    {
    	return view('Queries.queries');
    }

    function getActiveContracts()
    {
    	$data = DB::select('Select a.stallID as stallID, b.floorID as floorID, c.bldgName as bldgName, f.stypeName as stypeName, a.stallStatus as stallStatus,  e.stypeArea as stypeArea from tblstall a join tblfloor b join tblbuilding c join tblstalltype_stallsize d join tblstalltype_size e join tblstalltype f where a.floorID = b.floorID and b.bldgID = c.bldgID and a.stype_SizeID = d.stype_SizeID and e.stypeSizeID = d.stypeSizeID and d.stypeID = f.stypeID');
				//whereIn 

    	/*SELECT a.contractID as contractNo, b.stallID as stallID, CONCAT_WS(" ",c.stallHFName, c.stallHMName,c.stallHLName) as stallHolderName from tblcontractinfo a left join tblstallrental_info b left join tblstallholder c  where MONTH(a.created_at) = MONTH(CURRENT_DATE()) and a.stallRentalID = b.stallRentalID and c.stallHID = b.stallHID*/
			
    		return response()->json($data);
    }
    public function getExpiringContracts(){
        $data = DB::select("select date_format(contract.contractStart,'%M %d, %Y') as contractStart,
       date_format(contract.contractEnd,'%M %d, %Y') as contractEnd,
       CONCAT(tenant.stallHFName,' ', tenant.stallHMName, ' ', tenant.stallHLName) as tenantName,
       datediff(contract.contractEnd, curdate()) as days,
       contract.stallID
            from tblcontractinfo as contract 
            LEFT JOIN tblstallholder as tenant on tenant.stallHID = contract.stallHID 
            where contract.contractStart between (((curdate() - INTERVAL 1 year) + INTERVAL 1 MONTH) - interval (day(curdate())-1) day)
            AND last_day((curdate() - INTERVAL 1 year) + INTERVAL 1 MONTH) and 
            contract.deleted_at IS NULL");
        return response()->json($data);
    }
}
