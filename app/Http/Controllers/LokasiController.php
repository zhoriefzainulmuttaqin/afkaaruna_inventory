<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::orderBy('id', 'ASC')->paginate(10);
        $area = Area::all();

        return view('pages.lokasi', compact('lokasi', 'area'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required',
            'id_area' => 'required',
        ]);

        $lokasi = Lokasi::create([
            'lokasi' => $request->lokasi,
            'id_area' => $request->id_area,
        ]);

        if ($lokasi) {
            return redirect('lokasi')->with('success', 'Lokasi Berhasil Ditambahkan.');
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'lokasi' => 'required',
        ]);

        $lokasi = Lokasi::where('id', $request->id)->update([
            'lokasi' => $request->lokasi,
            'id_area' => $request->id_area,
        ]);

        if ($lokasi) {
            return redirect('lokasi')->with('success', 'Lokasi Berhasil Diedit.');
        }
    }

    public function delete(Request $request)
    {
        $del = Lokasi::where('id', $request->id)->delete();

        if ($del) {
            return redirect('lokasi')->with('success', 'Lokasi Berhasil Dihapus.');
        }
    }
}
