<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengajuan;
use App\Models\Perbaikan;
use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    public function index()
    {
        $perbaikan = Perbaikan::orderBy('id', 'ASC')->get();
        $barang = Barang::where('id_status', '=', '1')->orderBy('id', 'ASC')->get();
        $pendingCount = Pengajuan::where('id_status', 7)->count();

        return view('pages.perbaikan', compact('perbaikan', 'barang', 'pendingCount'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'tgl_mulai' => 'required',
            'biaya' => 'required',
            'keterangan' => 'required',
            'id_barang' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        // dd($request->errors()->all());
        $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();

        $request->foto->move(("foto_gudang"), $imageName);

        $perbaikan = Perbaikan::create([
            'tgl_mulai' => $request->tgl_mulai,
            'biaya' => $request->biaya,
            'keterangan' => $request->keterangan,
            'id_barang' => $request->id_barang,
            'foto' => $imageName
        ]);



        if ($perbaikan) {
            $barang = Barang::find($request->id_barang);

            $updateStock = $barang->stock - $request->jumlahBarang;

            Barang::where('id', $request->id_barang)->update([
                'stock' => $updateStock
            ]);

            $barang->refresh();

            if ($barang->stock == 0) {
                Barang::where('id', $request->id_barang)->update(['id_status' => 2]);
            }
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

        $perbaikan = Perbaikan::find($request->id);
        $barang = Barang::find($perbaikan->id_barang);

        $updateStock = $barang->stock + $perbaikan->jumlahBarang;

        Barang::where('id', $perbaikan->id_barang)->update([
            'stock' => $updateStock
        ]);

        $barang->refresh();

        if ($barang->stock > 0) {
            Barang::where('id', $request->id_barang)->update(['id_status' => 1]);
        }
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
