<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stall;
use App\StallType;
use App\Floor;
use App\Building;
use App\StallUtil;
class StallController extends Controller
{
    
		public function getStalls()
		{
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

		}
}
