<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Status;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::orderBy('id', 'DESC')->paginate(10);
        $kategori = Kategori::all();
        $lokasi = Lokasi::all();
        $status = Status::all();

        return view('pages.barang', compact('barang', 'kategori', 'lokasi', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tgl_masuk' => 'required',
            'kepemilikan' => 'required',
            'keterangan' => 'required',
            'id_kategori' => 'required',
            'id_lokasi' => 'required',
            'id_status' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',

        ]);

        $int = random_int(100000, 200000);

        $code = "AFKAA" . $int;

        $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();

        $request->foto->move(public_path('images/'), $imageName);

        $barang = Barang::create([
            'nama' => $request->nama,
            'code' => $code,
            'tgl_masuk' => $request->tgl_masuk,
            'kepemilikan' => $request->kepemilikan,
            'foto' => $imageName,
            'keterangan' => $request->keterangan,
            'id_kategori' => $request->id_kategori,
            'id_lokasi' => $request->id_lokasi,
            'id_status' => $request->id_status,
        ]);

        if ($barang) {
            return redirect('barang')->with('success', 'Barang Berhasil Ditambahkan.');
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tgl_masuk' => 'required',
            'kepemilikan' => 'required',
            'keterangan' => 'required',
            'id_kategori' => 'required',
            'id_lokasi' => 'required',
            'id_status' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        $imageName = $request->gambarLama;

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $image->move(public_path('images/'), $imageName);
        }

        $barang = Barang::where('id', $request->id)->update([
            'nama' => $request->nama,
            'tgl_masuk' => $request->tgl_masuk,
            'kepemilikan' => $request->kepemilikan,
            'foto' => $imageName,
            'keterangan' => $request->keterangan,
            'id_kategori' => $request->id_kategori,
            'id_lokasi' => $request->id_lokasi,
            'id_status' => $request->id_status,
        ]);

        if ($barang) {
            return redirect('barang')->with('success', 'Barang Berhasil Diedit.');
        }
    }

    public function delete(Request $request)
    {
        $del = Barang::where('id', $request->id)->delete();

        if ($del) {
            return redirect('barang')->with('success', 'barang Berhasil Dihapus.');
        }
    }
}
