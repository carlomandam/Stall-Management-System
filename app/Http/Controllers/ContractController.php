<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rent;
use App\Vendor;
use PDF;
class ContractController extends Controller
{
    public function index(){
        
            return view('transaction.Contracts');
   
    }

    public function view(){
        return view('transaction.ViewContracts');
    }
    public function showdetails(){
        return view ('transaction.ShowDetails');
    }

    public function create()
    {
        return view('transaction.CreateContract');
    }

    function getRentInfo(){
        $rent = Rent::join('tblvendor','tblrent_info.venID','=','tblvendor.venID')
            ->get();
        $data = array();
        foreach ($rent as $rent) {
            $rent['actions'] = "
          
            <button class='btn btn-primary' onclick='printpdf(this.value)' value = '".$rent['rentID']."' target = '_blank' ><span class='glyphicon glyphicon-print'></span> Print</button>

            <button class='btn btn-success' onclick='getInfo(this.value)' value = '".$rent['rentID']."' ><span class='glyphicon glyphicon-pencil'></span> Update</button>
             <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' disabled><span class=' glyphicon glyphicon-ban-circle'></span> Cancel</button>
           
            ";
            $data['data'][] = $rent;
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

    function printPdf()
    {   $rentID = $_POST['id'];
        $vendorID = Rent::where('rentID', $rentID)
        ->select('venID')
        ->get();
        $vendorData = Vendor::where('venID',$vendorID)->select('venFName')->get();
        view()->share('vendorData',$vendorData);

        $pdf = PDF::loadView('transaction.pdfview');

             $pdf->stream('VENDOR.pdf',array('Attachment'=>0));
            
     return view('transaction.pdfview');

    }
}

