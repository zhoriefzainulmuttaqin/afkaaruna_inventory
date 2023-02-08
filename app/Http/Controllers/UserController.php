<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User ::orderBy('id', 'ASC')->get();

        return view('pages.user ', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required',
        ]);

        $user  = user ::create([
            'user' => $request->user ,
        ]);

        if ($user ) {
            return redirect('user')->with('success', 'user  Berhasil Ditambahkan.');
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'user' => 'required',
        ]);

        $user  = user ::where('id', $request->id)->update([
            'user' => $request->user,
        ]);

        if ($user) {
            return redirect('user')->with('success', 'user  Berhasil Diedit.');
        }
    }

    public function delete(Request $request)
    {
        $del = user ::where('id', $request->id)->delete();

        if ($del) {
            return redirect('user')->with('success', 'user  Berhasil Dihapus.');
        }
    }
}
