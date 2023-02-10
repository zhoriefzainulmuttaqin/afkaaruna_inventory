<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Perbaikan;
use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    public function index()
    {
        $perbaikan = Perbaikan::orderBy('id', 'ASC')->get();
        $barang = Barang::all();

        return view('pages.perbaikan', compact('perbaikan', 'barang'));
    }
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'tgl_mulai	' => 'required',
            'tgl_selesai' => 'required',
            'biaya' => 'required',
            'keterangan' => 'required',
            'id_barang' => 'required',

        ]);

        $perbaikan = Perbaikan::create([
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'biaya' => $request->biaya,
            'keterangan' => $request->keterangan,
            'id_barang' => $request->id_barang,

        ]);

        // Perbaikan::where('id', $request->id_barang)->update(['id_status' => 2]);

        if ($perbaikan) {
            return redirect('perbaikan')->with('success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'tgl_mulai	' => 'required',
            'tgl_selesai' => 'required',
            'biaya' => 'required',
            'keterangan' => 'required',
            'id_barang' => 'required',
        ]);

        $perbaikan = Perbaikan::where('id', $request->id)->update([
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'biaya' => $request->biaya,
            'keterangan' => $request->keterangan,
            'id_barang' => $request->id_barang,
        ]);

        if ($perbaikan) {
            return redirect('perbaikan')->with('success', 'Data Berhasil Diedit.');
        }
    }

    public function delete(Request $request)
    {
        $del = Perbaikan::where('id', $request->id)->delete();

        if ($del) {
            return redirect('perbaikan')->with('success', 'Data Berhasil Dihapus.');
        }
    }
}
