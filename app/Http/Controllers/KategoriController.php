<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use PDO;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('id', 'ASC')->get();
        $pendingCount = Pengajuan::where('id_status', 5)->count();

        return view('pages.kategori', compact('kategori', 'pendingCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
        ]);

        $kategori = Kategori::create([
            'kategori' => $request->kategori
        ]);

        if ($kategori) {
            return redirect('kategori')->with('success', 'Kategori Berhasil Ditambahkan.');
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
        ]);

        $kategori = Kategori::where('id', $request->id)->update([
            'kategori' => $request->kategori
        ]);

        if ($kategori) {
            return redirect('kategori')->with('success', 'Kategori Berhasil Diedit.');
        }
    }

    public function delete(Request $request)
    {
        $del = Kategori::where('id', $request->id)->delete();

        if ($del) {
            return redirect('kategori')->with('success', 'Kategori Berhasil Dihapus.');
        }
    }
}
