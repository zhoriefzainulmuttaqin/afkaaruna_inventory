<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $area = Area::orderBy('id', 'ASC')->get();
        $pendingCount = Pengajuan::where('id_status', 5)->count();

        return view('pages.area', compact('area', 'pendingCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'area' => 'required',
        ]);

        $area = Area::create([
            'area' => $request->area,
        ]);

        if ($area) {
            return redirect('area')->with('success', 'Area Berhasil Ditambahkan.');
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'area' => 'required',
        ]);

        $area = Area::where('id', $request->id)->update([
            'area' => $request->area,
        ]);

        if ($area) {
            return redirect('area')->with('success', 'Area Berhasil Diedit.');
        }
    }

    public function delete(Request $request)
    {
        $del = area::where('id', $request->id)->delete();

        if ($del) {
            return redirect('area')->with('success', 'Area Berhasil Dihapus.');
        }
    }
}
