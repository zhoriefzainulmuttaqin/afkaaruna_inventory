<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = user::orderBy('id', 'ASC')->get();
        $pendingCount = Pengajuan::where('id_status', 5)->count();

        return view('pages.user', compact('user', 'pendingCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = user::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash the password
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
            'role' => 'required',
            'username' => 'required',
            'password' => 'required',

        ]);

        $user = user::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash the password
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
