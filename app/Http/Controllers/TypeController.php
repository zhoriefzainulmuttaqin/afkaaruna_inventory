<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $type = Type::orderBy('id', 'ASC')->get();
        $pendingCount = Pengajuan::where('id_status', 7)->count();

        return view('pages.type', compact('type', 'pendingCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        $type = Type::create([
            'type' => $request->type,
        ]);

        if ($type) {
            return redirect('type')->with('success', 'type Berhasil Ditambahkan.');
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        $type = Type::where('id', $request->id)->update([
            'type' => $request->type,
        ]);

        if ($type) {
            return redirect('type')->with('success', 'type Berhasil Diedit.');
        }
    }

    public function delete(Request $request)
    {
        $del = Type::where('id', $request->id)->delete();

        if ($del) {
            return redirect('type')->with('success', 'type Berhasil Dihapus.');
        }
    }
}
