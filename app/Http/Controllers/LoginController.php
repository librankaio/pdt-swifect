<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function postLogin(Request $request){
        // dd($request->all());
        if(Auth::attempt($request->only('username', 'password'))){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return redirect('/');
    }

    public function logout(request $request){
        Auth::logout();

        return redirect('/');
    }
}
