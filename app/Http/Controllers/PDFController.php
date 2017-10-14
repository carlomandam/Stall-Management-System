<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use PDF;
use App\Contract;
use App\Charges;
class PDFController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function pdfview(Request $request)
    {
        $rental = tblRental::with('Contract.StallRate.RateDetail','Stall.Floor.Building','StallHolder.ContractNo','Product')->where('StalRentalID',$_POST['rental'])->first();
        view()->share('rental',$rental);

        if($request->has('download')){
            $pdf = PDF::loadView('pdfview');
            return $pdf->download('pdfview.pdf');
        }

        return view('pdfview');
    }*/

    public function pdfcreate($rentalid)
    {
        $contract = Contract::with('StallRate','Stall.Floor.Building','StallHolder.ContactNo','Product')->where('contractID',$rentalid)->first();
        $charges = Charges::all();

        $data = array(
            'contract' => $contract,
            'charges' => $charges,
        );
        view()->share('data',$data);

        $pdf = PDF::loadView('transaction.pdfview');
        return $pdf->stream('contract.pdf');
    }    
}