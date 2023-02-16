<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = user::orderBy('id', 'ASC')->paginate(10);
        return view('pages.user', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = user::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if ($user) {
            return redirect('user')->with('success', 'user Berhasil Ditambahkan.');
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',

        ]);

        $user = user::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if ($user) {
            return redirect('user')->with('success', 'user Berhasil Diedit.');
        }
    }

    public function delete(Request $request)
    {
        $del = user::where('id', $request->id)->delete();

        if ($del) {
            return redirect('user')->with('success', 'user Berhasil Dihapus.');
        }
    }
}
