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

	public function regListIndex()
	{
		return view('transaction/ManageContracts/RegistrationList');
	}

	public function stallHListIndex()
	{
		return view('transaction/ManageContracts/StallHolderList');
	}
}
