<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Holiday;
class HolidayController extends Controller
{
    function getHolidays (){
    	$holidays = Holiday::all();
    	if(count($holidays) != 0){
    		$data = array();
    		foreach ($holidays as $holiday) {
    			$data['data'][] = $holiday;
    		}
    		return json_encode($data);
    	}
    	else{
    		return '{
            	"sEcho": 1,
            	"iTotalRecords": "0",
            	"iTotalDisplayRecords": "0",
            "aaData": []
        	}';
    	}
    }

	function addHoliday (){
		$holiday = new Holiday;
		$holiday->Name = $_POST['Name'];
		$holiday->Day = $_POST['Day'];
		$holiday->Month = $_POST['Month'];
		$holiday->save();
	}

	function updateHoliday (){
		$holiday = Holiday::find($_POST['id']);
		$holiday->Name = $_POST['Name'];
		$holiday->Day = $_POST['Day'];
		$holiday->Month = $_POST['Month'];
		if($holiday->isDirty()){
			$holiday->save();
			return 'true';
		}else{
			return 'false';
		}
	}

	function getHolidayInfo (){
		$holiday = Holiday::find($_POST['id']);
		return json_encode($holiday);
	}

	function deleteHoliday (){
		$holiday = Holiday::find($_POST['id']);
		$holiday->delete();
	}

	function CheckHolidayName (){
		$holiday = Holiday::where('Name',$_POST['Name'])->first();
		if($holiday != null){
			if(isset($_POST['ID'])){
				if ($holiday->ID == $_POST['ID'])
					return 'true';
				else
					return 'false';
			}
			else
				return 'false';
		}
		else
			return 'true';
	}

	function CheckHolidayDate (){
		$holiday = Holiday::where('Month',$_POST['Month'])->where('Day',$_POST['Day'])->first();
		if($holiday != null){
			if(isset($_POST['ID'])){
				if ($holiday->ID == $_POST['ID'])
					return 'true';
				else
					return 'false';
			}
			else
				return 'false';
		}
		else
			return 'true';
	}
}
