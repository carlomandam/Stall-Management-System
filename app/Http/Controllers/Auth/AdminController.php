<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminController extends Controller
{
    //
    public function showLoginForm(){

        if(Auth::check()){
            return redirect()->back();
        }
        else{
            return view('login.login');
        }
    	
    }

    public function login(Request $request){
    	

    	$this->validate($request,[
    		'email' => 'required|email',
    		'password' => 'required'
    	]);

    	if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password])){
    		return view('welcome');
    	}

    	return redirect()->back();
    }

     public function logout(){
         Auth::logout();
        return redirect('/login');
    } 
}
