<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'username' => ['required', 'string', 'min:3', 'alpha_num', 'max:25'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
            'confpass' => ['min:8'],
        ]);

        User::create([
            'username'=> $request->username,
            'email'=> $request->email,
            'password' => $request->password,
        ]);
        return redirect('/login');
    }
}
