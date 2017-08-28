<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Contract;
use App\StallRental;
use App\ContractInfo;
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
     * @var string,,iiii
     */
    protected $description = 'Insert products';

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

        $insert = \DB::table('tblProduct')->insert(
            ['productName' => 'sample1']
        );

     /*   $checkNewContracts = ContractInfo::all()
                             ->where('contractStart','=',date('Y-m-d'));
        if(count($checkNewContracts) > 0)
        {
            insertCurrentCollection();
        }*/
        $this->info('New Insert');

    }
    public function insertCurrentCollection()
    {
        
    }
}
