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
    function getStallTypes(){
    	$STypes = StallType::all();
    	$data = array();
    	foreach ($STypes as $SType) {
            $SType['actions'] = "<button class='btn btn-primary btn-flat' onclick='getInfo(this.value)' value = '".$SType['stypeID']."' ><span class='glyphicon glyphicon-pencil'></span> Update</button>
            
            <div class='btn-group'>
                <button type='button' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span> Deactivate</button></button>
                <ul class='dropdown-menu pull-right opensleft' role='menu'>
                    <center>
                        <h4>Are You Sure?</h4>
                        <li class='divider'></li>
                        <li><a href='#' onclick='deleteBuilding(".$SType['stypeID'].");return false;'>YES</a></li>
                        <li><a href='#' onclick='return false'>NO</a></li>
                    </center>
                </ul>
            </div>
            ";
    		$data['data'][] = $SType;
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
    
    function checkSTypeName(){
        $stype = StallType::where('stypeName',$_POST['stypeName'])->get();
        if(count($stype) != 0)
            return "false";
        else
            return "true";
    }
    
    function addStallType(){
        $stype = new StallType;
        
        $stype->stypeName = $_POST['stypeName'];
        $stype->stypeLength = ($_POST['stypeLength'] == '') ? 0 : $_POST['stypeLength'];
        $stype->stypeWidth = ($_POST['stypeWidth'] == '') ? 0 : $_POST['stypeWidth'];
        $stype->stypeDesc = $_POST['stypeDesc'];
        
        $stype->save();
    }
    
    function getSTypeInfo(){
        $stype = StallType::where('stypeID',$_POST['id'])->get();
        return (json_encode($stype));
    }
    
    function UpdateSType(){
        $stype = StallType::find($_POST['id']);
        $stype->stypeName = $_POST['stypeName'];
        $stype->stypeLength = ($_POST['stypeLength'] == '') ? 0 : $_POST['stypeLength'];
        $stype->stypeWidth = ($_POST['stypeWidth'] == '') ? 0 : $_POST['stypeWidth'];
        
        $stype->stypeDesc = $_POST['stypeDesc'];
        $stype->save();
    }
    
    function deleteSType(){
        $stype = StallType::find($_POST['id']);
        $stype->delete();
    }
    ////////////////////Stall
    function getStalls(){
    	$stalls = Stall::with('StallType','Floor.Building')->get();
    	$data = array();
    	foreach ($stalls as $stall) {
            $stall['actions'] = "<button class='btn btn-primary btn-flat' onclick='getInfo(this.value)' value = '".$stall['stallID']."' ><span class='glyphicon glyphicon-pencil'></span> Update</button>
            
            <div class='btn-group'>
                <button type='button' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span> Deactivate</button></button>
                <ul class='dropdown-menu pull-right opensleft' role='menu' data-container='body'>
                    <center>
                        <h4>Are You Sure?</h4>
                        <li class='divider'></li>
                        <li><a href='#' onclick='deleteStall(\"".$stall['stallID']."\");return false;'>YES</a></li>
                        <li><a href='#' onclick='return false'>NO</a></li>
                    </center>
                </ul>
            </div>
            ";
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
    
    function getBuildingOption(){
    	$building = Building::with("Floor")->get();
    	return (json_encode($building));
    }
    
    function getSTypeOption(){
    	$stype = StallType::with('StallRate')->get();
    	return (json_encode($stype));
    }
    
    function getStallID(){
    	$stall = Stall::withTrashed()->where('stallID','LIKE',$_POST['code']."-".$_POST['floor']."%")->orderBy('stallID','desc')->first();
        $id = "";
        if(Empty($stall)){
            $id = $_POST['code']."-".$_POST['floor']."01";
        }
        else{
            preg_match_all('!\d+$!', $stall->stallID, $matches);
            $id = $_POST['code']."-".($matches[0][0]+1);
        }
    	return ($id);
    }
    
    function addStall(){
        $stall = new Stall;
        $stall->stallID = $_POST['stallID'];
        $stall->stypeID = $_POST['type'];
        $stall->floorID = $_POST['floor'];
        $stall->stallStatus = 1;
        if($stall->save() && isset($_POST['util'])){
            for($i = 0; $i < count($_POST['util']);$i++){
            $stallutil = StallUtil::where('stallID',$_POST['stallID'])->where('utilID',$_POST['util'][$i])->first();
            if(Empty($stallutil)){
                $stallutil = new StallUtil;
                $stallutil->stallID = $stall->stallID;
                $stallutil->utilID = $_POST['util'][$i];
                $stallutil->RateType = $_POST['utilRadio'.$_POST['util'][$i]];
                $stallutil->Rate =(isset($_POST['utilAmount'.$_POST['util'][$i]]) ? $_POST['utilAmount'.$_POST['util'][$i]] : 0);
                $stallutil->meterID = (isset($_POST['meter'.$_POST['util'][$i]])) ? $_POST['meter'.$_POST['util'][$i]] : null;
                if($stallutil->isDirty()){
                    $stallutil->save();
                    $hasChange = true;  
                }
            }
            else{
                $stallutil->RateType = $_POST['utilRadio'.$_POST['util'][$i]];
                $stallutil->Rate =(isset($_POST['utilAmount'.$_POST['util'][$i]]) ? $_POST['utilAmount'.$_POST['util'][$i]] : 0);
                $stallutil->meterID = (isset($_POST['meter'.$_POST['util'][$i]])) ? $_POST['meter'.$_POST['util'][$i]] : null;
                if($stallutil->isDirty()){
                    $stallutil->save();
                    $hasChange = true;
                }
            }
            }
        }
    }
    ///////////////Utilities
    function getUtilities(){
        $utilities = Utility::all();
        return (json_encode($utilities));
    }
    
    function getStallInfo(){
        $stall = Stall::with('StallUtil.Utility','StallType','Floor.Building')->where('stallID',$_POST['id'])->get();
        return (json_encode($stall[0]));
    }
    
    function updateStall(){
        $hasChange = false;
        $stall = Stall::where('stallID',$_POST['stallID'])->first();
        $stall->stypeID = (isset($_POST['type'])) ? $_POST['type'] : null;
        if($stall->isDirty()){
            $stall->save();
            $hasChange = true;
        }
        if(isset($_POST['util'])){
            for($i = 0; $i < count($_POST['util']);$i++){
                $stallutil = StallUtil::where('stallID',$_POST['stallID'])->where('utilID',$_POST['util'][$i])->first();
                if(Empty($stallutil)){
                    $stallutil = new StallUtil;
                    $stallutil->stallID = $stall->stallID;
                    $stallutil->utilID = $_POST['util'][$i];
                    $stallutil->RateType = $_POST['utilRadio'.$_POST['util'][$i]];
                    $stallutil->Rate =(isset($_POST['utilAmount'.$_POST['util'][$i]]) ? $_POST['utilAmount'.$_POST['util'][$i]] : 0);
                    $stallutil->meterID = (isset($_POST['meter'.$_POST['util'][$i]])) ? $_POST['meter'.$_POST['util'][$i]] : null;
                    if($stallutil->isDirty()){
                        $stallutil->save();
                        $hasChange = true;  
                    }
                }
                else{
                    $stallutil->RateType = $_POST['utilRadio'.$_POST['util'][$i]];
                    $stallutil->Rate =(isset($_POST['utilAmount'.$_POST['util'][$i]]) ? $_POST['utilAmount'.$_POST['util'][$i]] : 0);
                    $stallutil->meterID = (isset($_POST['meter'.$_POST['util'][$i]])) ? $_POST['meter'.$_POST['util'][$i]] : null;
                    if($stallutil->isDirty()){
                        $stallutil->save();(isset($_POST['meter'.$_POST['util'][$i]])) ? $_POST['meter'.$_POST['util'][$i]] : null;
                        $hasChange = true;
                    }
                }
            }
        }
        echo $hasChange;
    }
    
    function deleteStall(){
        $stall = Stall::find($_POST['id']);
        $stall->delete();
    }
    
    function addStallRate(){
        $rate = StallRate::where('stypeID', $_POST['stypeID'])->where('bldgID',($_POST['bldgID'] == 0) ? null : $_POST['bldgID'])->get();
        if(count($rate) !== 0)
            return "exist";
        $rate = new StallRate;
        $rate->bldgID = ($_POST['bldgID'] == 0) ? null : $_POST['bldgID'];
        $rate->stypeID = $_POST['stypeID'];
        $rate->sratePrice = $_POST['amt'];
        $rate->collection = $_POST['collection'];
        $rate->save();
    }
    
    function getStallRates(){
    	$rates = StallRate::with('StallType','Building')->get();
    	$data = array();
    	foreach ($rates as $rate) {
            $rate['actions'] = "<button class='btn btn-success' onclick='getInfo(this.value)' value = '".$rate['srateID']."' ><span class='glyphicon glyphicon-pencil'></span> Update</button>
            ";
            switch($rate['collection']){
                case 1 :
                    $rate['collection'] = 'Daily';
                    break;
                case 2 :
                    $rate['collection'] = 'Weekly';
                    break;
                case 3 :
                    $rate['collection'] = 'Monthly';
                    break;
                    
            }
    		$data['data'][] = $rate;
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
    
    function getRateInfo(){
        $rate = StallRate::with('Building','StallType')->where('srateID',$_POST['id'])->get();
        return (json_encode($rate));
    }
    
    function updateRate(){
        $changed = 'false';
        $rate = StallRate::where('srateID',$_POST['id'])->first();
        $rate->bldgID = ($_POST['bldgID'] == 0) ? null : $_POST['bldgID'];
        $rate->sratePrice = $_POST['amt'];
        $rate->collection = $_POST['collection'];
        if($rate->isDirty()){
            $rate->save();
            $changed = 'true';   
        }
        echo $changed;
    }
    
    function checkRate(){
        $rate = StallRate::where('stypeID',$_POST['stype'])->where('bldgID',$_POST['bldgID'])->where('srateID','!=',isset($_POST['id']) ? $_POST['id'] : null)->get();
        if(count($rate) > 0)
            return "false";
        else
            return "true";
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