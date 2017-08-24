<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Contract;
use App\StallRental;
use DB;

class CustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert collections';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $rate = DB::table('tblContract as contract')
        ->select('*')
        ->leftJoin('tblStallRental_info as rental','contract.stallRentID',"=","rental.stallRentID")->groupBy('contract.contractID')
        ->leftJoin('tblStall as stall','rental.stallID','=','stall.stallID')
        ->leftJoin('tblStallType_StallSize as type','stall.stype_SizeID',"=",'type.stype_SizeID')
        ->leftJoin('tblStallRate as rate',function($q){
            $q->leftJoin('type.stype_SizeID','=','rate.stype_SizeID')->where('stallRateEffectivity','<=','date(contract.created_at)')->orderBy('rate.stallRateEffectivity','DESC')->first();
        })->groupBy('type.stype_SizeID')->get();

        return json_encode($rate);
        /*DB::table('tblStall')
            ->select('*')
            ->leftJoin('tblstalltype_stallsize as type','tblStall.stype_sizeID','=','type.stype_sizeID')->leftJoin*/
    }
}
