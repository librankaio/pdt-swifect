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
            $data = $request->only('username');
            $user = $data['username'];
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success','Selamat Datang, '.$user);
        }
        $request->session()->flash('flash_message_error', 'Username atau Password anda Salah !');
        
        return redirect('/');
    }

    public function logout(request $request){
        Auth::logout();

        return redirect('/');
    }
}
