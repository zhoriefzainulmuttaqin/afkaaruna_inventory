<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use PDO;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('id', 'ASC')->get();

        return view('pages.kategori', compact('kategori'));
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
            return redirect('kategori');
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
            return redirect('kategori');
        }
    }

    public function delete(Request $request)
    {
        $del = Kategori::where('id', $request->id)->delete();

        if ($del) {
            return redirect('kategori');
        }
    }
}
