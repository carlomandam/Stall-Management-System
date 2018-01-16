<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Auth;
class AdminController extends Controller
{

    public function showLoginForm(){
        if(Auth::check()){
            return redirect()->back();
        }
        else
            return view('login.login');    
    }

    public function login(Request $request){	

    	$this->validate($request,[
    		'email' => 'required|email',
    		'password' => 'required'
    	]);

    	if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password])){
    		return redirect()->intended('/Dashboard');
    	}else{
            return redirect('/login')->withInput($request->except('password'))->withErrors(['password' => 'Invalid email or password']);
        }

    	return redirect('login');

    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/login');
    } 
}