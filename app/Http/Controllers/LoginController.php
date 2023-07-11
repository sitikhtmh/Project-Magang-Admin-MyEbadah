<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\User;
use Auth;

use Session;

class LoginController extends Controller
{
    public function getlogin()
    {
        return view('login');
    }

    public function postlogin(Request $request)
    {
        // dd($request->all());

        // if(Auth::attempt($request->only('username', 'password'))){
        //     return redirect('/dashboard.index');
        // }

        // return redirect('/login');

        $username = $request->username;
        $password = $request->password;
        $login = DB::select("SELECT * FROM [User] where username = '$username' AND password = '$password '");
        $logins = User::where('username',$username)->where('password',$password)->first();

        if($login)
        {
            Session::put('USERNAME',$username);
            Session::put('Role_Id',$logins['role_id']);
            Session::put('login',TRUE);

            return view('welcome');

        }

        else
        {
            return redirect('/')->with('error','maaf username dan password salah');
        }
    }


    public function logout(){

        Session::flush();

        return redirect('/');
    }

    
  
}
