<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Stall;
use App\StallType;
use App\Floor;
use App\Building;
use App\StallUtility;
class StallController extends Controller
{
    function getStalls(){
        $stalls = Stall::with('Floor.Building','StallType.StallType','StallType.StallTypeSize')->get();
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

    function getStallsTrashed(){
        $stalls = Stall::onlyTrashed()->with('Floor.Building','StallType.StallType','StallType.StallTypeSize')->get();
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
    
    function getBuildingOption(){
    	$building = Building::with("Floor")->get();
    	return (json_encode($building));
    }
    
    function getSTypeOption(){
        $stype = StallType::with('STypeSize')->get();
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
    
    function getStallInfo(){
        $stall = Stall::withTrashed()->with('StallType','Floor.Building','StallUtility')->where('stallID',$_POST['id'])->get();
        return (json_encode($stall[0]));
    }
    
    function addStall(){
        $stall = new Stall;
        $stall->stallID = $_POST['stallID'];
        $stall->stype_SizeID = $_POST['type'];
        $stall->floorID = $_POST['floor'];
        $stall->stallDesc = $_POST['desc'];
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
    
    function getStallList(){
        $stalls = Building::with('Floor.Stall')->get();
        return (json_encode($stalls));
    }
    
    function updateStall(){
        $hasChange = "false";
        $stall = Stall::where('stallID',$_POST['stallID'])->first();
        $stall->stype_SizeID = (isset($_POST['type'])) ? $_POST['type'] : null;
        $stall->stallDesc = $_POST['desc'];
        if($stall->isDirty()){
            $stall->save();
            $hasChange = "true";
        }
        
        $electricity = StallUtility::where('stallID',$stall->stallID)->where('utilityType','1')->first();
        if(isset($_POST['electricity']) && count($electricity) == 0){
            $electricity = new StallUtility;
            $electricity->stallID = $stall->stallID;
            $electricity->utilityType = 1;
            $electricity->save();
            $hasChange = "true";
        }
        else if(!isset($_POST['electricity']) && count($electricity) > 0){
            $electricity->delete();
            $hasChange = "true";
        }
        
        $water = StallUtility::where('stallID',$stall->stallID)->where('utilityType','2')->first();        
        if(isset($_POST['water']) && count($water) == 0){
            $water = new StallUtility;
            $water->stallID = $stall->stallID;
            $water->utilityType = 2;
            $water->save();
            $hasChange = "true";
        }
        else if(!isset($_POST['water']) && count($water) > 0){
            $water->delete();
            $hasChange = "true";
        }
        
        echo $hasChange;
    }
    
    function updateStalls(){
        if(!isset($_POST['stalls']))
            return "false";
        foreach($_POST['stalls'] as $stall){
            $temp = Stall::where('stallId',$stall)->first();
            $temp->stype_SizeID = $_POST['type'];
            
            if($_POST['desc'] != '')
                $temp->stallDesc = $_POST['desc'];
            
            if($temp->isDirty())
                $temp->save();
            
            if(isset($_POST['electricity'])){
                $electricity = StallUtility::where('stallID',$temp->stallID)->where('utilityType','1')->first();
                if(count($electricity) == 0){
                    $electricity = new StallUtility;
                    $electricity->stallID = $temp->stallID;
                    $electricity->utilityType = 1;
                }
                $electricity->save();
            }
            
            if(isset($_POST['water'])){
                $water = StallUtility::where('stallID',$temp->stallID)->where('utilityType','2')->first();
                if(count($water) == 0){
                    $water = new StallUtility;
                    $water->stallID = $temp->stallID;
                    $water->utilityType = 2;
                }
                $water->save();
            }
        }
    }
}