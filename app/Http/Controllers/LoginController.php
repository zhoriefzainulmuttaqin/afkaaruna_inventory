<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function formLogin()
    {
        return view('login/login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('peminjaman'); // Redirect to admin page
            } else {
                return redirect('pengajuan'); // Redirect to user's page
            }
        }

        return redirect()->back()->with('error', 'Username or Password Are Wrong.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
