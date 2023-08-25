<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Lokasi;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::orderBy('id', 'ASC')->get();
        $area = Area::all();
        $pendingCount = Pengajuan::where('id_status', 5)->count();

        return view('pages.lokasi', compact('lokasi', 'area', 'pendingCount'));
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
