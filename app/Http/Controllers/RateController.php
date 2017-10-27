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

    function datesDisabled(){
        $data = array();
        foreach ($_POST['stype'] as $type) {
            $stype = StallRate::where('stype_SizeID',$_POST['stype'])->get();
            foreach ($stype as $i) {
                array_push($data,date("m/d/Y", strtotime($i->stallRateEffectivity)));
            }
        }

        return (json_encode($data));
    }
    
    function addStallRate(){
        foreach($_POST['stype'] as $x){
            $rate = new StallRate;
            $rate->stype_SizeID = $x;
            $rate->dblRate = $_POST['rate'];
            $rate->dblPeakAdditional = $_POST['prate'];
            $rate->peakRateType = $_POST['prtype'];
            $rate->stallRateEffectivity = date_format(date_create($_POST['effect']),"Y-m-d");
            $rate->save();  
        }
    }
    
    function getStallRates(){
        $rates = StallRate::with('typeSize.StallType','typeSize.StallTypeSize')->orderBy('created_at','ASC')->get();
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
    
    function checkRate(){
        $rate = StallRate::where('stypeID',$_POST['stype'])->where('bldgID',$_POST['bldgID'])->where('srateID','!=',isset($_POST['id']) ? $_POST['id'] : null)->get();
        if(count($rate) > 0)
            return "false";
        else
            return "true";
    }
}
