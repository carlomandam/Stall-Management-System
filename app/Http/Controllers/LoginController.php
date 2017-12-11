<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Closure;

class LoginController extends Controller
{
    //
    public function login(){
    	return view('login/login');
    }
    
    public function validateUser(Request $request){
    	$this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

         if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            // return redirect('/Dashboard');
            return redirect('/login/goTo');
        } 
        else 
        {
            // return redirect()->back()->with('message','email and password did not exist');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
    
    public function addUsers(){
        return view('login.register');
    }
}
