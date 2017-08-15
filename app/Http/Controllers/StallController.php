<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Stall;
use App\StallType;
use App\Floor;
use App\Building;
use App\StallUtil;
class StallController extends Controller
{
    /*public function getStalls(){
				$stall = Stall::with('Floor.Building','StallType')->get();
				//whereIn 
				$data = array();

				foreach($stall as $Stall)
				{
					$Stall["actions"] =   "<button class='btn btn-primary'  data-toggle=
                  'modal' data-target='#update' onclick='getInfo(this.value)' value = '".$Stall['stallID']."' >Update</button>"
                    ;
                    $Stall['utilities'] = 
            	   $data['data'][] = $Stall;
				} if(count($data) == 0){
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
    }*/
    function updateStall(){
        $hasChange = false;
        $stall = Stall::where('stallID',$_POST['stallID'])->first();
        $stall->stype_SizeID = (isset($_POST['type'])) ? $_POST['type'] : null;
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
    
    function getStalls(){
    	$stalls = DB::table('tblStall')
            ->select('*')
            ->leftJoin('tblstalltype_stallsize as type','tblStall.stype_sizeID','=','type.stype_sizeID')
            ->leftJoin('tblstalltype as stype','type.stypeID','=','stype.stypeID')
            ->leftJoin('tblstalltype_size as size', 'type.stypeSizeID', '=', 'size.stypeSizeID')
            ->leftJoin('tblFloor as floor','tblStall.floorID','=','floor.floorID')
            ->leftJoin('tblBuilding as bldg','floor.bldgID','=','bldg.bldgID')
            ->get();
    	$data = array();
    	foreach ($stalls as $stall) {
            $stall->actions = "<button class='btn btn-primary btn-flat' onclick='getInfo(this.value)' value = '".$stall->stallID."' ><span class='glyphicon glyphicon-pencil'></span> Update</button>
            
            <div class='btn-group'>
                <button type='button' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span> Deactivate</button></button>
                <ul class='dropdown-menu pull-right opensleft' role='menu' data-container='body'>
                    <center>
                        <h4>Are You Sure?</h4>
                        <li class='divider'></li>
                        <li><a href='#' onclick='deleteStall(\"".$stall->stallID."\");return false;'>YES</a></li>
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
    
    function addStall(){
        $stall = new Stall;
        $stall->stallID = $_POST['stallID'];
        $stall->stype_SizeID = $_POST['type'];
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
}
