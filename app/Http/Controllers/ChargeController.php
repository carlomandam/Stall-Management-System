<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charges;
class ChargeController extends Controller
{
    function addCharge(){
        $charge = new Charges;
        $charge->chargeName = trim($_POST['Name']);
        $charge->chargeAmount = $_POST['Amount'];
        $charge->chargeDesc = $_POST['Desc'];

        $charge->save();
    }
    
    function updateCharge(){
        $charge = Charges::where('chargeID',$_POST['id'])->first();
        $charge->chargeName = trim($_POST['Name']);
        $charge->chargeAmount = $_POST['Amount'];
        $charge->chargeDesc = $_POST['Desc'];
        
        if($charge->isDirty()){
            $charge->save();
            return 'true';
        }
        else
            return 'false';
    }
    
    function deleteCharge(){
        $charge = Charges::where('chargeID',$_POST['id'])->first();
        $charge->delete();
    }

    function archiveCharges(){
        $charge = Charges::withTrashed()
                            ->whereNotNull('deleted_at')
                             ->get();
                  return(json_encode($charge))           
    }
    function restoreCharges($id){
       $charge = Charges::withTrashed()
                            ->findOrFail($id)
                            ->restore();         
    }
    
    function checkChargeName(){
        if(isset($_POST['id'])){
            $charge = Charges::where('chargeName',trim($_POST['Name']))->where('chargeID',$_POST['id'])->get();
            if(count($building) == 1)
                return "true";
        }
        
        $charge = Charges::where('chargeName',trim($_POST['Name']))->get();
        if(count($charge) != 0)
            return "false";
        else
            return "true";
    }
    
    function getChargeInfo(){
        $charges = Charges::where('chargeID',$_POST['id'])->first();
        return (json_encode($charges));
    }
    
    function getCharges(){
    	$charges = Charges::all();
    	$data = array();
    	foreach ($charges as $charge) {
            $charge['actions'] = "<button class='btn btn-primary btn-flat' onclick='getInfo(this.value)' value = '".$charge['chargeID']."' ><span class='glyphicon glyphicon-pencil'></span> Update</button>
            
            <div class='btn-group'>
                <button type='button' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span> Deactivate</button></button>
                <ul class='dropdown-menu pull-right opensleft' role='menu'>
                    <center>
                        <h4>Are You Sure?</h4>
                        <li class='divider'></li>
                        <li><a href='#' onclick='deleteBuilding(".$charge['chargeID'].");return false;'>YES</a></li>
                        <li><a href='#' onclick='return false'>NO</a></li>
                    </center>
                </ul>
            </div>
            ";
    		$data['data'][] = $charge;
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
}
