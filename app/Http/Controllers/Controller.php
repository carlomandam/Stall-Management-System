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
}