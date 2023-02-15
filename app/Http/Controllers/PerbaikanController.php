<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Perbaikan;
use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    public function index()
    {
        $perbaikan = Perbaikan::orderBy('id', 'ASC')->paginate(10);
        $barang = Barang::where('id_status', '=', '1')->orderBy('id', 'ASC')->get();

        return view('pages.perbaikan', compact('perbaikan', 'barang'));
    }
    public function store(Request $request)
    {
        // dd($request);
        // $request->validate([
        //     'tgl_mulai    ' => 'required',
        //     'biaya' => 'required',
        //     'keterangan' => 'required',
        //     'id_barang' => 'required',

        // ]);

        $perbaikan = Perbaikan::create([
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'biaya' => $request->biaya,
            'keterangan' => $request->keterangan,
            'id_barang' => $request->id_barang,

        ]);

        Barang::where('id', $request->id_barang)->update(['id_status' => 3]);

        if ($perbaikan) {
            return redirect('perbaikan')->with('success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'tgl_selesai' => 'required',
        ]);

        Perbaikan::where('id', $request->id)->update([
            'tgl_selesai' => $request->tgl_selesai,
        ]);

        Barang::where('id', $request->id)->update(['id_status' => 1]);

        return redirect('perbaikan')->with('success', 'Data Berhasil Diedit.');
    }

    public function delete(Request $request)
    {
        $del = Perbaikan::where('id', $request->id)->delete();

        if ($del) {
            return redirect('perbaikan')->with('success', 'Data Berhasil Dihapus.');
        }
    }
}
