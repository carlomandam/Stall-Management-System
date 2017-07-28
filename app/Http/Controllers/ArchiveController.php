<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    
    function buildingIndex()
    {
    	return view('archives.Archive_Building');
    }

    function stallTypeIndex()
    {
    	return view('archives.Archive_StallType');
    }

    function stallIndex()
    {
    	return view('archives.Archive_Stall');
    }
}
