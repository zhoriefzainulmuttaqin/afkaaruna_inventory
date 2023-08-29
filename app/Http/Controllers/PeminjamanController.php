<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::orderBy('id', 'ASC')->get();
        $barang = Barang::where('id_status', '=', '1')->orderBy('nama', 'ASC')->get();
        $pendingCount = Pengajuan::where('id_status', 5)->count();
        $area = Area::all();

        return view('home', compact('peminjaman', 'barang', 'pendingCount', 'area'));
    }

    public function store(Request $request)
    {

        $barang = Barang::find($request->id_barang);

        // Check if the barang exists and has sufficient stock
        if (!$barang || $barang->stock < $request->jumlahBarang) {
            return redirect('peminjaman')->with('error', 'Stock barang tidak tersedia.');
        }

        // dd($request);
        $request->validate([
            'tgl_peminjaman' => 'required',
            'id_barang' => 'required',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        // $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();

        // $request->foto->move(("foto_gudang"), $imageName);

        $peminjaman = Peminjaman::create([
            'tgl_peminjaman' => $request->tgl_peminjaman,
            'id_barang' => $request->id_barang,
            'jumlahBarang' => $request->jumlahBarang

        ]);


        if ($peminjaman) {
            $barang = Barang::find($request->id_barang);

            $updateStock = $barang->stock - $request->jumlahBarang;

            Barang::where('id', $request->id_barang)->update([
                'stock' => $updateStock
            ]);

            $barang->refresh();

            if ($barang->stock == 0) {
                Barang::where('id', $request->id_barang)->update(['id_status' => 2]);
            }

            return redirect('peminjaman')->with('success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'tgl_pengembalian' => 'required',
        ]);

        Peminjaman::where('id', $request->id)->update([
            'tgl_pengembalian' => $request->tgl_pengembalian,
        ]);

        $peminjaman = Peminjaman::find($request->id);

        $barang = Barang::find($peminjaman->id_barang);

        $updateStock = $barang->stock + $peminjaman->jumlahBarang;

        Barang::where('id', $peminjaman->id_barang)->update([
            'stock' => $updateStock
        ]);

        $barang->refresh();

        if ($barang->stock > 0) {
            Barang::where('id', $request->id_barang)->update(['id_status' => 1]);
        }

        return redirect('peminjaman')->with('success', 'Data Berhasil Diedit.');
    }


    public function delete(Request $request)
    {
        $del = Peminjaman::where('id', $request->id)->delete();

        if ($del) {
            return redirect('peminjaman')->with('success', 'Data Berhasil Dihapus.');
        }
    }
}
