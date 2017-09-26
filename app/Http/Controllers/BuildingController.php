<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use App\Floor;
use App\Stall;

class BuildingController extends Controller
{
    //
    function addBuilding(){
        $building = new Building;
        
        $building->bldgName = trim($_POST['bldgName']);
        $building->bldgCode = trim($_POST['bldgCode']);
        $building->bldgDesc = trim($_POST['bldgDesc']);
        
        if($building->save()){
            
            for($i = 0;$i < $_POST['noOfFloor']; $i++){
                $floor = new Floor;
                $floor->floorLevel = $i+1;
                $floor->bldgID = $building->bldgID;
                $floor->save();
                
                for($j = 1;$j <= $_POST['noOfStall'][$i];$j++){
                    $stall = new Stall;
                    $stall->stallID = $this->stallID($building->bldgCode,$floor->floorLevel);
                    $stall->floorID = $floor->floorID;
                    $stall->stallStatus = 1;
                    $stall->save();
                }
            }
        }
    }
    
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
    
    function getBuildingCode(){
        if($_POST['name'] == null)
            return;
        else if(strlen(trim($_POST['name']," "))<5)
            return "short";
        $startTime = time();
        $string = trim($_POST['name'];
        $codes = array('mbldig','mnbig','mildg');
        $newcode = $codes[1];
        
        do{
            $newcode = $string[0];
            $last = array(0);
            for($i = 4;$i>0;$i--){
                
                do{
                    $rand = rand(end($last),strlen($string)-1);
                    if(time() - $startTime > 5)
                        return "timeout";
                }while($rand > strlen($string)-$i || in_array($rand,$last));
                
                $newcode = $newcode.$string[$rand];
                $last[] = $rand;
            }
            if(time() - $startTime > 30)
                return "timeout";
        }
        while(in_array($newcode,$codes));
        
        return $newcode;
    }
    
    function getBuildings(){
    	$building = Building::all();
    	$data = array();
    	foreach ($building as $building) {
            $building['floor'] = count(Floor::where('bldgID',$building->bldgID)->get());
            $building['actions'] = "<button class='btn btn-primary btn-flat' onclick='getInfo(this.value)' value = '".$building['bldgID']."' ><span class='glyphicon glyphicon-pencil'></span> Update</button>
            
            <div class='btn-group'>
                <button type='button' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span> Deactivate</button></button>
                <ul class='dropdown-menu pull-right opensleft' role='menu'>
                    <center>
                        <h4>Are You Sure?</h4>
                        <li class='divider'></li>
                        <li><a href='#' onclick='deleteBuilding(".$building['bldgID'].");return false;'>YES</a></li>
                        <li><a href='#' onclick='return false'>NO</a></li>
                    </center>
                </ul>
            </div>
            ";
    		$data['data'][] = $building;
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

    function getBuildingsTrashed(){
        $building = Building::onlyTrashed()->with('Floor')->get();
        $data = array();
        foreach ($building as $building) {
            $data['data'][] = $building;
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
    
    function checkBldgName(){
        if(isset($_POST['id'])){
            $building = Building::where('bldgName',$_POST['bldgName'])->where('bldgID',$_POST['id'])->get();
            if(count($building) == 1)
                return "true";
        }
        
        $building = Building::where('bldgName',$_POST['bldgName'])->get();
        if(count($building) != 0)
            return "false";
        else
            return "true";
    }
    
    function checkBldgCode(){
        if(isset($_POST['id'])){
            $building = building::where('bldgCode',$_POST['bldgCode'])->where('bldgID',$_POST['id'])->get();
            if(count($building) == 1)
                return "true";
        }
        
        $building = building::where('bldgCode',$_POST['bldgCode'])->get();
        
        if(count($building) != 0)
            return "false";
        else
            return "true";
    }
    
    function getBuildingInfo(){
        $building = Building::withTrashed()->where('bldgID',$_POST['id'])->get();
        $building[0]['noOfFloor'] = Building::withTrashed()->where('bldgID',$_POST['id'])->first()->Floor()->count();
        return (json_encode($building));
    }
    
    function UpdateBuilding(){
        $hasChange = false;
        $building = Building::find($_POST['id']);
        $building->bldgName = trim($_POST['bldgName']);
        $building->bldgCode = trim($_POST['bldgCode']);
        $building->bldgDesc = trim($_POST['bldgDesc']);
        if($building->isDirty()){
            $building->save();
            $hasChange = true;
        }
        
        if(isset($_POST['noOfFloorUp'])){
            for($i = 0;$i < $_POST['noOfFloorUp'];$i++){
                $floor = new Floor;
                $floor->bldgID = $building->bldgID;
                $last = Floor::where('bldgID',$building->bldgID)->orderBy('floorLevel','desc')->first();

                if(count($last) > 0)
                    $floor->floorLevel = $last->floorLevel + 1;
                else
                     $floor->floorLevel = 1;

                $floor->save();

                for($j = 1;$j < $_POST['noOfStall'][$i]+1;$j++){
                    $stall = new Stall;
                    $stall->stallID = $this->stallID($building->bldgCode,$floor->floorLevel);
                    $stall->floorID = $floor->floorID;
                    $stall->stallStatus = 1;
                    $stall->save();
                }
                $hasChange = true;
            }
        }
        else if(isset($_POST['remove'])){
            for($i = 0;$i < $_POST['remove'];$i++){
                $floor = Floor::where('bldgID',$building->bldgID)->orderBy('floorLevel','desc')->first();
                $stalls = Stall::where('floorID',$floor->floorID)->has('CurrentTennant')->get();
                if(count($stalls) > 0){
                    return "rental";
                }

                $stalls = Stall::where('floorID',$floor->floorID)->get();
                foreach ($stalls as $stall) {
                    $stall->forceDelete();
                }
                $floor->forceDelete();
                $hasChange = true;
            }
        }
        echo $hasChange;
    }
    
    function deleteBuilding(){
        $building = Building::find($_POST['id']);
        foreach($building->Floor()->get() as $floor){
            $stalls = Stall::where('floorID',$floor->floorID)->has('CurrentTennant')->get();
            if(count($stalls) > 0){
                return "rental";
            }
        }
        $building->delete();
    }
    
    function getFloors(){
        $floors = Floor::with('stall')->where('bldgID',$_POST['id'])->get();
        return (json_encode($floors));
    }

    function restore(){
        $building = Building::onlyTrashed()->find($_POST['id']);
        $building->restore();
    }
}
