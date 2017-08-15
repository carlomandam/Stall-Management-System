<?php

namespace App\Http\Controllers;

use App;
use App\StallType;
use App\StallRate;
use App\Stall;
use App\Utility;
use App\StallUtil;
use App\Fee;
use App\Penalty;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function stallID($code,$floor){
    	$stall = Stall::where('stallID','LIKE',$code."-".$floor."%")->orderBy('stallID','desc')->first();
        $id = "";
        if(Empty($stall)){
            $id = $code."-".$floor."01";
        }
        else{
            preg_match_all('!\d+$!', $stall->stallID, $matches);
            $id = $code."-".($matches[0][0]+1);
        }
    	return ($id);
    }
    
    ///////////////////////// Stall Type
    ////////////////////Stall
    ///////////////Utilities
    function getUtilities(){
        $utilities = Utility::all();
        return (json_encode($utilities));
    }
    
    function getStallInfo(){
        $stall = Stall::with('StallType','Floor.Building')->where('stallID',$_POST['id'])->get();
        return (json_encode($stall[0]));
    }
    
    function deleteStall(){
        $stall = Stall::find($_POST['id']);
        $stall->delete();
    }
    
    function getFees(){
    	$Fees = Fee::all();
    	$data = array();
    	foreach ($Fees as $Fee) {
            $Fee['actions'] = "<button class='btn btn-success' onclick='getInfo(this.value)' value = '".$Fee['feeID']."' ><span class='glyphicon glyphicon-pencil'></span> Update</button>
            
            <div class='btn-group'>
                <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span> Deactivate</button></button>
                <ul class='dropdown-menu pull-right opensleft' role='menu'>
                    <center>
                        <h4>Are You Sure?</h4>
                        <li class='divider'></li>
                        <li><a href='#' onclick='deleteBuilding(".$Fee['feeID'].");return false;'>YES</a></li>
                        <li><a href='#' onclick='return false'>NO</a></li>
                    </center>
                </ul>
            </div>
            ";
    		$data['data'][] = $Fee;
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
    
    function addFee(){
        $fee = new Fee;
        $fee->feeName = $_POST['feeName'];
        $fee->feeAmount = $_POST['feeAmount'];
        $fee->feeDesc = $_POST['feeDesc'];
        $fee->save();
    }
    
    function updateFee(){
        $hasChange = false;
        $fee = Fee::where('feeID',$_POST['feeID'])->first();
        $fee->feeName = $_POST['feeName'];
        $fee->feeAmount = $_POST['feeAmount'];
        $fee->feeDesc = $_POST['feeDesc'];
        
        if($fee->isDirty()){
            $fee->save();
            $hasChange = true;
        }
        echo $hasChange;
    }
    
    function deleteFee(){
        $fee = Fee::find($_POST['id']);
        $fee->delete();
    }
    
    function getFeeInfo(){
        $fee = Fee::where('feeID',$_POST['id'])->get();
        return (json_encode($fee));
    }
    
    function getPenalties(){
    	$penalties = Penalty::with('Fee')->get();
    	$data = array();
    	foreach ($penalties as $penalty) {
            $penalty['actions'] = "<button class='btn btn-success' onclick='getInfo(this.value)' value = '".$penalty['penID']."' ><span class='glyphicon glyphicon-pencil'></span> Update</button>
            
            <div class='btn-group'>
                <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span>Deactivate</button>
                <ul class='dropdown-menu pull-right opensleft' role='menu'>
                    <center>
                        <h4>Are You Sure?</h4>
                        <li class='divider'></li>
                        <li><a href='#' onclick='deleteBuilding(".$penalty['penID'].");return false;'>YES</a></li>
                        <li><a href='#' onclick='return false'>NO</a></li>
                    </center>
                </ul>
            </div>
            ";
    		$data['data'][] = $penalty;
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
    
    function addPenalty(){
        $penalty = new Penalty;
        $penalty->penName = $_POST['penName'];
        $penalty->feeID = ($_POST['for'] == 0) ? null : $_POST['for']; 
        $penalty->penAmount = $_POST['penAmount'];
        $penalty->penType = $_POST['type'];
        $penalty->penDays = $_POST['days'];
        $penalty->penDesc = $_POST['desc'];
        $penalty->save();
    }
    
    function updatePenalty(){
        $hasChange = false;
        $penalty = Penalty::where('penID',$_POST['id'])->first();
        
        $penalty->penName = $_POST['penName'];
        $penalty->feeID = ($_POST['for'] == 0) ? null : $_POST['for']; 
        $penalty->penAmount = $_POST['penAmount'];
        $penalty->penType = $_POST['type'];
        $penalty->penDays = $_POST['days'];
        $penalty->penDesc = $_POST['desc'];
        
        if($penalty->isDirty()){
            $penalty->save();
            $hasChange = true;
        }
        echo $hasChange;
    }
    
    function deletePenalty(){
        $penalty = Penalty::find($_POST['id']);
        $penalty->delete();
    }
    
    function getPenaltyInfo(){
        $penalty = Penalty::where('penID',$_POST['id'])->get();
        return (json_encode($penalty));
    }
    
    function getUtilitiesTable(){
    	$utils = Utility::all();
    	$data = array();
    	foreach ($utils as $util) {
            $util['actions'] = "<button class='btn btn-success' onclick='getInfo(this.value)' value = '".$util['utilID']."' ><span class='glyphicon glyphicon-pencil'></span> Update</button>
            
            <div class='btn-group'>
                <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span> Delete</button></button>
                <ul class='dropdown-menu pull-right opensleft' role='menu'>
                    <center>
                        <h4>Are You Sure?</h4>
                        <li class='divider'></li>
                        <li><a href='#' onclick='deleteUtility(".$util['utilID'].");return false;'>YES</a></li>
                        <li><a href='#' onclick='return false'>NO</a></li>
                    </center>
                </ul>
            </div>
            ";
    		$data['data'][] = $util;
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
    
    function addUtility(){
        $util = new Utility;
        $util->utilName = $_POST['name'];
        $util->utilDesc = $_POST['desc'];
        $util->isMetered = (isset($_POST['metered'])) ? $_POST['metered'] : 2;
        $util->save();
    }
    
    function updateUtility(){
        $hasChange = false;
        $util = Utility::where('utilID',$_POST['id'])->first();
        $util->utilName = $_POST['name'];
        $util->utilDesc = $_POST['desc'];
        $util->isMetered = (isset($_POST['metered'])) ? $_POST['metered'] : 2;
        
        if($util->isDirty()){
            $util->save();
            $hasChange = true;
        }
        echo $hasChange;
    }
    
    function deleteUtility(){
        $util = Utility::find($_POST['id']);
        $util->delete();
    }
    
    function getUtilityInfo(){
        $util = Utility::where('utilID',$_POST['id'])->get();
        return (json_encode($util));
    }
    
    function getFeesOpt(){
        $fees = Fee::all();
        return json_encode($fees);
    }
}