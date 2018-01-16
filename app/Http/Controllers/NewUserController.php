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
    	User::create(["fname" => $request->fname, "mname" => $request->mname, "lname" => $request->lname, "email" => $request->email, "password" => bcrypt($request->pass), "position" => $request->role ]);
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

    function info(Request $request){
        $user = User::find($request->id);
        return json_encode($user);
    }

    function update(Request $request){
        $error = array();
        $user = User::find($request->id);
        $user->fname = $request->fname;
        $user->mname = $request->mname;
        $user->lname = $request->lname;

        if(count(User::where("email",$request->email)->where('id',"!=",$request->id)) > 1)
            $error = "email";
        else
            $user->email = $request->email;

        if($request->pass != $request->pass_confirmation)
            $error = "pass";
        else
            $user->password = $request->pass;
        
        if(count($error) > 1)
            return json_encode($error);
        else
            $user->save();

        return "success";
    }

    function remove(Request $request){
        $user = User::find($request->id);
        $user->delete();
        return redirect('NewUser')->with("Status","Deleted");
    }
}
