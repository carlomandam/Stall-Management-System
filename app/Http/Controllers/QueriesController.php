<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\MonthlyReading;
use App\StallMeter;
use PDF;
use Carbon\Carbon;
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

    public function getTerminatedContracts(){
         $data = DB::select("select date_format(contract.contractStart,'%M %d, %Y') as contractStart,
                            date_format(contract.deleted_at,'%M %d, %Y') as contractEnd,
                            CONCAT(tenant.stallHFName,' ', tenant.stallHMName, ' ', tenant.stallHLName) as tenantName,
                            contract.contractReason as reasons,
                            contract.stallID from tblcontractinfo as contract 
                            LEFT JOIN tblstallholder as tenant on tenant.stallHID = contract.stallHID
                            where contract.contractStart IS NOT NULL AND contract.contractEnd IS NOT NULL and contract.deleted_at IS NOT NULL and                                       contract.contractReason IS NOT NULL");
        return response()->json($data);

    }
    public function getExpiringContracts(){
       /* $data = DB::select("select date_format(contract.contractStart,'%M %d, %Y') as contractStart,
       date_format(contract.contractEnd,'%M %d, %Y') as contractEnd,
       CONCAT(tenant.stallHFName,' ', tenant.stallHMName, ' ', tenant.stallHLName) as tenantName,
       datediff(contract.contractEnd, curdate()) as days,
       contract.stallID
            from tblcontractinfo as contract 
            LEFT JOIN tblstallholder as tenant on tenant.stallHID = contract.stallHID 
            where contract.contractStart between (((curdate() - INTERVAL 1 year) + INTERVAL 1 MONTH) - interval (day(curdate())-1) day)
            AND last_day((curdate() - INTERVAL 1 year) + INTERVAL 1 MONTH) and 
            contract.deleted_at IS NULL");*/
    $data = DB::select("select date_format(contract.contractStart,'%M %d, %Y') as contractStart,
                            date_format(contract.contractEnd,'%M %d, %Y') as contractEnd,
                            CONCAT(tenant.stallHFName,' ', tenant.stallHMName, ' ', tenant.stallHLName) as tenantName,
                            datediff(contract.contractEnd, curdate()) as days,
                            contract.stallID from tblcontractinfo as contract 
                            LEFT JOIN tblstallholder as tenant on tenant.stallHID = contract.stallHID
                            where contract.contractStart IS NOT NULL AND contract.contractEnd IS NOT NULL and contract.deleted_at IS  NULL");
        return response()->json($data);
    }

    public function getExpiredContracts(){
         $data = DB::select("select date_format(contract.contractStart,'%M %d, %Y') as contractStart,
                            date_format(contract.contractEnd,'%M %d, %Y') as contractEnd,
                            CONCAT(tenant.stallHFName,' ', tenant.stallHMName, ' ', tenant.stallHLName) as tenantName,
                            datediff(contract.contractEnd, curdate()) as days,
                            contract.stallID from tblcontractinfo as contract 
                            LEFT JOIN tblstallholder as tenant on tenant.stallHID = contract.stallHID
                            where contract.contractStart IS NOT NULL AND contract.contractEnd IS NOT NULL and contract.deleted_at IS NOT  NULL and contract.contractReason IS NULL");
        return response()->json($data);
    }

    public function getElectricConsumption(){

        $data = DB::select("select  CONCAT(date_format(month.readingFrom,'%M %d, %Y'),' - ', date_format(month.readingTo,'%M %d, %Y')) as reading, concat(month.presReading-month.prevReading,' kWh') as totalRead, (SELECT contract.stallID from tblcontractinfo as contract where contract.contractID = meter.contractID) as stallCode,meter.utilityAmt as amt,
            (select DISTINCT CONCAT((sub.presRead- sub.prevRead),' kWh') as cons from tblstall_utilities as su JOIN tblcontractinfo as contract 
                    JOIN tblsubmeter as sub on sub.subMeterID = su.stallUtilityID where su.stallID = contract.stallID and su.stallUtilityID = sub.stallUtilityID) as cons from tblmonthlyreading as month
                    JOIN tblstallutilities_meterid as meter 
                    JOIN tblcontractinfo as contract on contract.contractID = meter.contractID
                    where meter.utilityAmt = (SELECT MAX(utilityAmt) from tblstallutilities_meterid as m where m.readingID = month.readingID) and month.utilType = 1 and month.isFinalize = 1");
       return response()->json($data);

    }

    public function getWaterConsumption(){

        $data =  DB::select("select  CONCAT(date_format(month.readingFrom,'%M %d, %Y'),' - ', date_format(month.readingTo,'%M %d, %Y')) as reading, concat(month.presReading-month.prevReading,' kWh') as totalRead, (SELECT contract.stallID from tblcontractinfo as contract where contract.contractID = meter.contractID) as stallCode,meter.utilityAmt as amt,
            (select DISTINCT CONCAT((sub.presRead- sub.prevRead),' kWh') as cons from tblstall_utilities as su JOIN tblcontractinfo as contract 
                    JOIN tblsubmeter as sub on sub.subMeterID = su.stallUtilityID where su.stallID = contract.stallID and su.stallUtilityID = sub.stallUtilityID) as cons from tblmonthlyreading as month
                    JOIN tblstallutilities_meterid as meter 
                    JOIN tblcontractinfo as contract on contract.contractID = meter.contractID
                    where meter.utilityAmt = (SELECT MAX(utilityAmt) from tblstallutilities_meterid as m where m.readingID = month.readingID) and month.utilType = 2 and month.isFinalize = 1");
        return response()->json($data);
    }

    function printNotice($id)
    {$data = DB::select("Select a.stallID as stallID, b.floorID as floorID, c.bldgName as bldgName, f.stypeName as stypeName, a.stallStatus as stallStatus,  e.stypeArea as stypeArea, date_format(con.contractEnd,'%M %d, %Y') as endcon from tblstall a join tblfloor b join tblbuilding c join tblstalltype_stallsize d join tblstalltype_size e join tblstalltype f join tblcontractinfo as con on con.stallID = a.stallID where a.floorID = b.floorID and b.bldgID = c.bldgID and a.stype_SizeID = d.stype_SizeID and e.stypeSizeID = d.stypeSizeID and d.stypeID = f.stypeID and a.stallID = '$id'");
     //  return view('pdf/contractRenewal',compact('data'));

           $pdf = PDF::loadview('pdf/contractRenewal',compact('data'));
        return $pdf->stream(Carbon::today()->format('Ymd').'contractRenewal.pdf');
    }
}
