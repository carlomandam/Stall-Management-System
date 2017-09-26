<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use PDF;
use App\StallRental;
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
        $rental = StallRental::with('Contract.StallRate','Stall.Floor.Building','StallHolder.ContactNo','Product')->where('StallRentalID',$rentalid)->first();
        $charges = Charges::all();

        $data = array(
            'rental' => $rental,
            'charges' => $charges,
        );
        view()->share('data',$data);

        $pdf = PDF::loadView('transaction.pdfview');
        return $pdf->stream('contract.pdf');
    }    
}