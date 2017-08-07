<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageContractsController extends Controller
{
    //'

	public function stallListIndex()
	{
		return view('transaction/ManageContracts/MappingTable');
	}
}
