<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallType;
use App\Stall;
use App\StallTypeSize;
use App\StallType_StallTypeSize;

class StallTypeController extends Controller
{
    function getStallTypes(){
    	$STypes = StallType::with('STypeSize')->get();
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

    function getStallTypesTrashed(){
        $STypes = StallType::onlyTrashed()->with('STypeSize')->get();
        $data = array();
        foreach ($STypes as $SType) {
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
        $stype->stypeDesc = $_POST['stypeDesc'];
        
        if($stype->save()){
            foreach($_POST['size'] as $x){
                $size = StallTypeSize::where('stypeArea',$x)->first();
                if(count($size) > 0){
                    $stype->STypeSize()->attach($size->stypeSizeID);
                }
                else{
                    $size = new StallTypeSize;
                    $size->stypeArea = $x;
                    $size->save();
                    $stype->STypeSize()->attach($size->stypeSizeID);
                }
            }
        }
    }
    
    function getSTypeInfo(){
        $stype = StallType::withTrashed()->with('STypeSize')->where('stypeID',$_POST['id'])->get();
        return (json_encode($stype));
    }
    
    function UpdateSType(){
        $hasChange = false;
        $stype = StallType::find($_POST['id']);
        $stype->stypeName = $_POST['stypeName'];
        $stype->stypeDesc = $_POST['stypeDesc'];
        if($stype->isDirty()){
            $stype->save();
            $hasChange = true;
        }
        
        foreach($_POST['newSize'] as $x){
            if($x != ''){
                $size = StallTypeSize::where('stypeArea',$x)->first();
                if(count($size) > 0 && !$stype->STypeSize()->where('tblStallType_StallSize.stypeSizeID', $size->stypeSizeID)->exists()){
                    $stype->STypeSize()->attach($size->stypeSizeID);
                }
                else{
                    $size = new StallTypeSize;
                    $size->stypeArea = $x;
                    $size->save();
                    $stype->STypeSize()->attach($size->stypeSizeID);
                }
                $hasChange = true;
            }
        }
        echo $hasChange;
    }
    
    function deleteSType(){
        $stypes = StallType_StallTypeSize::where('stypeID',$_POST['id'])->get();
        foreach ($stypes as $stype) {
            $stalls = Stall::where('stype_SizeID',$stype->stype_SizeID)->has('CurrentTennant')->get();
            if(count($stalls) > 0){
                return "rental";
            }
        }

        $stype = StallType::find($_POST['id']);
        $stypes = StallType_StallTypeSize::where('stypeID',$_POST['id'])->get();
        foreach ($stypes as $st) {
            $stalls = Stall::where('stype_SizeID',$st->stype_SizeID)->get();

            foreach($stalls as $stall){
                $stall->stype_SizeID = null;
                $stall->save();
            }
        }
        $stype->delete();
    }
    
    function getSizes(){
        $sizes = StallTypeSize::all();
        return (json_encode($sizes));
    }
    
    function deleteStypeSize(){
        $stype = StallType_StallTypeSize::where('stypeID',$_POST['type'])->where('stypeSizeID',$_POST['size'])->first();
        $stalls = Stall::where('stype_SizeID',$stype->stype_SizeID)->has('CurrentTennant')->get();
        if(count($stalls) > 0){
            return "rental";
        }

        $stype = StallType::find($_POST['type']);
        $stype->STypeSize()->detach($_POST['size']);
        return "success";
    }

    function restore(){
        $stype = StallType::onlyTrashed()->find($_POST['id']);
        $stype->restore();
    }
}