<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class NewUserController extends Controller
{
    function index(){
    	return view('userRegistration');
    }

    function register(Request $request){
    	$this->validator($request);
    	User::create(["name"=>$request->fname.' '.$request->lname, "email" => $request->email, "password" => bcrypt($request->pass), "position" => $request->role ]);
    	return redirect('NewUser')->with("Status","Success");
    }

    function validator(Request $request)
    {
        return $this->validate($request, [
            'fname' => 'required|string|max:255',
            'mname' => 'string|max:255',
            'lname' => 'required|string|max:255',
            'pass' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'pass' => 'required|confirmed|max:255'
        ]);
    }
}
