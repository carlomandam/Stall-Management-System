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

    function getUtilities(){
        $utilities = Utility::all();
        return (json_encode($utilities));
    }
    
    function deleteStall(){
        $stall = Stall::find($_POST['id']);
        $stall->delete();
    }
}