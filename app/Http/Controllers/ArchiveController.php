<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    
    function buildingIndex()
    {
    	return view('archives.Archive_Building');
    }
}
