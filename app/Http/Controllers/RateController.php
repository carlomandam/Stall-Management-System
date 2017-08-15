<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StallRate;
use App\StallRateDetail;

class RateController extends Controller
{
    function addStallRate(){
        foreach($_POST['stype'] as $x){
            $rate = new StallRate;
            $rate->stype_SizeID = $x;
            $rate->frequencyID = $_POST['collection'];
            $rate->stallRateEffectivity = date_format(date_create($_POST['effect']),"Y-m-d");
            if($rate->save()){
                return $rate->stallRateID.'yow';
                $i = 1;
                foreach($_POST['rate'] as $r){
                    $detail = new StallRateDetail;
                    $detail->stallRateDesc = $i;
                    $detail->stallRateID = $rate->stallRateID;
                    $detail->dblRate = $r;
                    $detail->save();
                    $i++;
                }
            }   
        }
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
}
