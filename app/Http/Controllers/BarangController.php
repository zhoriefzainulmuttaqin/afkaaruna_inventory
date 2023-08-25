<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Pengajuan;
use App\Models\Status;
use App\Models\Type;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::orderBy('id', 'DESC')->get();
        $kategori = Kategori::all();
        $lokasi = Lokasi::all();
        $type = Type::all();
        $area = Area::all();
        $status = Status::all();
        $pendingCount = Pengajuan::where('id_status', 5)->count();

        return view('pages.barang', compact('barang', 'kategori', 'lokasi', 'status', 'area', 'type', 'pendingCount'));
    }

    public function print(Request $request)
    {
        $query = Barang::query();

        $query->when($request->filled('kategori'), function ($q) use ($request) {
            return $q->where('id_kategori', $request->input('kategori'));
        });

        $query->when($request->filled('type'), function ($q) use ($request) {
            return $q->where('type', $request->input('type'));
        });

        $query->when($request->filled('tgl_masuk_awal') && $request->filled('tgl_masuk_akhir'), function ($q) use ($request) {
            $tgl_masuk_awal = $request->input('tgl_masuk_awal');
            $tgl_masuk_akhir = $request->input('tgl_masuk_akhir');
            return $q->whereBetween('tgl_masuk', [$tgl_masuk_awal, $tgl_masuk_akhir]);
        });

        $query->when($request->filled('status'), function ($q) use ($request) {
            return $q->where('id_status', $request->input('status'));
        });

        $barang = $query->orderBy('id', 'DESC')->get();
        $kategori = Kategori::all();
        $type = Type::all();
        $lokasi = Lokasi::all();
        $status = Status::all();

        return view('export.pdf_barang', compact('barang', 'kategori', 'lokasi', 'status'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'nama' => 'required',
        //     'tgl_masuk' => 'required',
        //     'id_type' => 'required',
        //     'id_kategori' => 'required',
        //     'id_lokasi' => 'required',
        //     'id_area' => 'required',
        //     'id_area' => 'required',
        //     'id_status' => 'required',
        //     // 'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        //     'stock' => 'required',

        // ]);

        $int = random_int(100000, 200000);

        $code = "AFKAA" . $int;

        // $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();

        // $request->foto->move(("foto_gudang"), $imageName);

        $barang = Barang::create([
            'nama' => $request->nama,
            'code' => $code,
            'tgl_masuk' => $request->tgl_masuk,
            'id_type' => $request->id_type,
            'keterangan' => $request->keterangan,
            // 'foto' => $imageName,
            'id_kategori' => $request->id_kategori,
            'id_area' => $request->id_area,
            'id_lokasi' => $request->id_lokasi,
            'id_status' => $request->id_status,
            'stock' => $request->stock,
        ]);

        if ($barang) {
            return redirect('barang')->with('success', 'Barang Berhasil Ditambahkan.');
        }
    }

    public function edit(Request $request)
    {
        // $request->validate([
        //     'nama' => 'required',
        //     'tgl_masuk' => 'required',
        //     'id_type' => 'required',
        //     'id_kategori' => 'required',
        //     'id_area' => 'required',
        //     'id_lokasi' => 'required',
        //     'id_status' => 'required',
        //     'stock' => 'required',
        //     // 'foto' => 'required',
        // ]);

        $imageName = $request->gambarLama;

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $image->move(public_path('foto_gudang/'), $imageName);
        }

        $barang = Barang::where('id', $request->id)->update([
            'nama' => $request->nama,
            'tgl_masuk' => $request->tgl_masuk,
            'id_type' => $request->id_type,
            'foto' => $imageName,
            'id_kategori' => $request->id_kategori,
            'id_area' => $request->id_area,
            'id_lokasi' => $request->id_lokasi,
            'id_status' => $request->id_status,
            'stock' => $request->stock,
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

    public function barang_user()
    {
        $barang = Barang::orderBy('id', 'DESC')->get();
        $kategori = Kategori::all();
        $lokasi = Lokasi::all();
        $area = Area::all();
        $status = Status::all();

        return view('user.pages.barang', compact('barang', 'kategori', 'lokasi', 'status', 'area'));
    }
}
