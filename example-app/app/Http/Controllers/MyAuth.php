<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class MyAuth extends Controller
{
    function login_view(){
        return view('login');
    }

    function login_process(Request $req){
        $req->validate([
        'user_email' => 'required|email',
        'user_password' => 'required|min:6',
        ]);

        $data = Users::all();
        // use Illuminate\Support\Facades\Auth;
        if(Auth::attempt(['user_email' => $data['user_email'], 'user_password' => $data['user_password']])){
            return Redirect::to('students');
        }else{
            return Redirect::to('login');
        }
    }

    function logout_process(){
        Auth::logout();
        return Redirect::to('login');
    }


    function register_view(){
        return view('register');
    }

    function register_process(Request $req){
        $req->validate([
        'user_fname' => 'required',
        'user_lname' => 'required',
        'user_email' => 'required|email|unique:users',
        'user_password' => 'required|min:6|confirmed',
        ]);

        $data = $req->all();

        User::create($data);

        return Redirect::to('login');
    }
}
