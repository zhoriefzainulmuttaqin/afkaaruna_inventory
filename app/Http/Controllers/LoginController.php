<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('login/login');
    }

    public function loginproses(Request $request){
        if(Auth::attempt($request->only('username','password'))){
            return redirect('admin');
        }
        
        return redirect('login');
    }
}
