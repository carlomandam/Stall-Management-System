<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use PDF;
use App\Contract;
use App\Charges;
use App\Transaction;
use App\InitialFee;
use DB;
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

    public function pdfcreate($rentalid){
        $contract = Contract::with('StallRate','Stall.Floor.Building','StallHolder.ContactNo','Product')->where('contractID',$rentalid)->first();
        $charges = Charges::all();
        
        $marketDays = DB::table('tblUtilities as a')
        ->where('utilitiesID','util_market_days') 
        ->select('utilitiesDesc')
        ->get()[0]->utilitiesDesc;
        $peakDays = DB::table('tblUtilities as a')
            ->where('utilitiesID','util_peak_days') 
            ->select('utilitiesDesc')
            ->get()[0]->utilitiesDesc;

        $peak = explode(",", $peakDays);
        $mdays = explode(",", $marketDays);

        $days = array();

        $sec = InitialFee::where('initDesc','Security Deposit')->latest()->first()->initAmt;
        $main = InitialFee::where('initDesc','Maintenance Fee')->latest()->first()->initAmt;

        $data = array(
            'contract' => $contract,
            'charges' => $charges,
            'mdays' => $mdays,
            'pdays' => $peak,
            'sec' => $sec,
            'main' => $main
        );
        view()->share('data',$data);

        $pdf = PDF::loadView('transaction.pdfview');
        return $pdf->stream('contract.pdf');
    }

    public function receipt($id){
        $transact = Transaction::find($id);

        $data = array(
            'tran' => $transact
        );
        view()->share('data',$data);

        $pdf = PDF::loadView('transaction.receipt');
        return $pdf->stream('receipt.pdf');
    }
}