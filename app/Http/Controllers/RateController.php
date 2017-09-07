<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRate;
use App\StallRateDetail;
use App\StallType;
use App\StallTypeSize;
use App\StallType_StallTypeSize;

class RateController extends Controller
{
    function getStallTypes(){
        
        $types = StallType::with('typesize.StallRate','typesize.StallTypeSize')->get();
        return (json_encode($types));
    }
    
    function addStallRate(){
        foreach($_POST['stype'] as $x){
            $rate = new StallRate;
            $rate->stype_SizeID = $x;
            $rate->dblRate = $_POST['rate'];
            $rate->dblPeakRate = $_POST['prate'];
            $rate->peakRateType = $_POST['prtype'];
            $rate->stallRateEffectivity = date_format(date_create($_POST['effect']),"Y-m-d");
            $rate->save();  
        }
    }
    
    function getStallRates(){
        $typesize = StallRate::distinct('stype_SizeID')->pluck('stype_SizeID')->toArray();
        $rates = array();
        
        foreach($typesize as $tz){
            
            $temp = StallRate::with('typeSize.StallType','typeSize.StallTypeSize')->where('stallRateEffectivity','<=',date('Y-m-d'))->where('stype_SizeID',$tz)->orderBy('created_at','DESC')->first();
            if($temp != null)
                array_push($rates, $temp);
            else{
                $temp = StallRate::with('typeSize.StallType','typeSize.StallTypeSize','RateDetail')->where('stallRateEffectivity','>',date('Y-m-d'))->where('stype_SizeID',$tz)->orderBy('created_at','ASC')->first();
                if($temp != null)
                    array_push($rates, $temp);
            }
        }
        //return $rates;
        
    	//$rates = StallRate::with('typeSize.StallType','typeSize.StallTypeSize','RateDetail')->get();
    	$data = array();
    	foreach ($rates as $rate) {
            $rate['actions'] = "<button class='btn btn-success' onclick='getInfo(this.value)' value = '".$rate['stallRateID']."' ><span class='glyphicon glyphicon-pencil'></span> Update</button>
            ";
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
    
    function getPrevStallRates(){
        $cur = StallRate::where('stallRateID',$_POST['id'])->first();
        if(count($cur) == 0){
            echo '{
            	"sEcho": 1,
            	"iTotalRecords": "0",
            	"iTotalDisplayRecords": "0",
            "aaData": []
        	}';

        	return;
        }
    	$rates = StallRate::with('typeSize.StallType','typeSize.StallTypeSize','RateDetail')->onlyTrashed()->where('stype_SizeID',$cur->stype_SizeID)->get();
    	$data = array();
    	foreach ($rates as $rate) {
            $rate['actions'] = "<button class='btn btn-success' onclick='getPrevInfo(this.value)' value = '".$rate['stallRateID']."' ><span class='glyphicon glyphicon-pencil'></span>Details</button>
            ";
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
    
    function getUpStallRates(){
        $cur = StallRate::where('stallRateID',$_POST['id'])->first();
        if(count($cur) == 0){
            echo '{
            	"sEcho": 1,
            	"iTotalRecords": "0",
            	"iTotalDisplayRecords": "0",
            "aaData": []
        	}';

        	return;
        }
    	$rates = StallRate::with('typeSize.StallType','typeSize.StallTypeSize','RateDetail')->where('stallRateEffectivity','>',date('Y-m-d'))->where('stype_SizeID',$cur->stype_SizeID)->get();
    	$data = array();
    	foreach ($rates as $rate) {
            $rate['actions'] = "<button class='btn btn-success' onclick='getUpInfo(this.value)' value = '".$rate['stallRateID']."' ><span class='glyphicon glyphicon-pencil'></span>Details</button>
            ";
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
        $rate = StallRate::with('typeSize.StallType','typeSize.StallTypeSize','RateDetail')->where('stallRateID',$_POST['id'])->first();
        return (json_encode($rate));
    }
    
    function getForbidden(){
        $forbidden = StallRate::where('stype_SizeID',$_POST['id'])->pluck('stallRateEffectivity')->toArray();
        $i = 0;
        foreach($forbidden as $x){
            $forbidden[$i] = date_format(date_create($x),"m/d/Y");
            $i++;
        }
        return (json_encode($forbidden));
    }
    
    function getPrevRateInfo(){
        $rate = StallRate::with('typeSize.StallType','typeSize.StallTypeSize','RateDetail')->onlyTrashed()->where('stallRateID',$_POST['id'])->get();
        return (json_encode($rate));
    }
    
    function getUpRateInfo(){
        $rate = StallRate::with('typeSize.StallType','typeSize.StallTypeSize','RateDetail')->where('stallRateID',$_POST['id'])->get();
        return (json_encode($rate));
    }
    
    function updateRate(){
        if($_POST['id'] == 'new')
            $this->addStallRate();
        else{
            $rate = StallRate::where('stallRateID',$_POST['id'])->first();
            $rate->frequencyID = $_POST['collection'];
            $rate->stallRateEffectivity = date_format(date_create($_POST['effect']),"Y-m-d");
            if($rate->save()){
                $i = 1;
                foreach($_POST['rate'] as $r){
                    $detail = StallRateDetail::where('stallRateID',$_POST['id'])->where('stallRateDesc',$i)->first();
                    if($detail == null){
                        $detail = new StallRateDetail;
                        $detail->stallRateID = $_POST['id'];
                        $detail->stallRateDesc = $i;
                    }
                    $detail->dblRate = $r;
                    $detail->save();
                    $i++;
                }
            }
        }
        
        /*$changed = 'false';
        $rate = StallRate::where('srateID',$_POST['id'])->first();
        $rate->bldgID = ($_POST['bldgID'] == 0) ? null : $_POST['bldgID'];
        $rate->sratePrice = $_POST['amt'];
        $rate->collection = $_POST['collection'];
        if($rate->isDirty()){
            $rate->save();
            $changed = 'true';   
        }
        echo $changed;*/
    }
    
    function checkRate(){
        $rate = StallRate::where('stypeID',$_POST['stype'])->where('bldgID',$_POST['bldgID'])->where('srateID','!=',isset($_POST['id']) ? $_POST['id'] : null)->get();
        if(count($rate) > 0)
            return "false";
        else
            return "true";
    }
}
