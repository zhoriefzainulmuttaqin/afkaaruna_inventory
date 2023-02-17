<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::orderBy('id', 'ASC')->get();
        $barang = Barang::where('id_status', '=', '1')->orderBy('id', 'ASC')->get();

        return view('home', compact('peminjaman', 'barang'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'tgl_peminjaman' => 'required',
            'peminjam' => 'required',
            'keterangan' => 'required',
            'id_barang' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();

        $request->foto->move(public_path('images/'), $imageName);

        $peminjaman = Peminjaman::create([
            'tgl_peminjaman' => $request->tgl_peminjaman,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'peminjam' => $request->peminjam,
            'keterangan' => $request->keterangan,
            'id_barang' => $request->id_barang,
            'foto' => $imageName

        ]);

        Barang::where('id', $request->id_barang)->update(['id_status' => 2]);

        if ($peminjaman) {
            return redirect('peminjaman')->with('success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'tgl_pengembalian' => 'required',
        ]);

        Peminjaman::where('id', $request->id)->update([
            'tgl_pengembalian' => $request->tgl_selesai,
        ]);

        Barang::where('id', $request->id)->update(['id_status' => 1]);

        return redirect('perbaikan')->with('success', 'Data Berhasil Diedit.');
    }


    public function delete(Request $request)
    {
        $del = Peminjaman::where('id', $request->id)->delete();

        if ($del) {
            return redirect('peminjaman')->with('success', 'Data Berhasil Dihapus.');
        }
    }
}
