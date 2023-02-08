<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::orderBy('id','ASC')->get();
        $barang = Barang::all();

        return view('home', compact('peminjaman','barang'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'tgl_peminjaman' => 'required',
            'tgl_pengembalian' => 'required',
            'peminjam' => 'required',
            'keterangan' => 'required',
            'id_barang' => 'required',
           
        ]);

        $peminjaman = Peminjaman::create([
            'tgl_peminjaman' => $request->tgl_peminjaman,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'peminjam' => $request->peminjam,
            'keterangan' => $request->keterangan,
            'id_barang' => $request->id_barang,
            
        ]);

        

        if ($peminjaman) {
            return redirect('peminjaman')->with('success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'tgl_peminjaman' => 'required',
            'tgl_pengembalian' => 'required',
            'peminjam' => 'required',
            'keterangan' => 'required',
            'id_barang' => 'required',
        ]);

        $peminjaman = Peminjaman::where('id', $request->id)->update([
            'tgl_peminjaman' => $request->tgl_peminjaman,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'peminjam' => $request->peminjam,
            'keterangan' => $request->keterangan,
            'id_barang' => $request->id_barang,
        ]);

        if ($peminjaman) {
            return redirect('peminjaman')->with('success', 'Data Berhasil Diedit.');
        }
    }

    public function delete(Request $request)
    {
        $del = Peminjaman::where('id', $request->id)->delete();

        if ($del) {
            return redirect('peminjaman')->with('success', 'Data Berhasil Dihapus.');
        }
    }
}
