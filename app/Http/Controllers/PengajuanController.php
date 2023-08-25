<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Status;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuan = Pengajuan::orderBy('id', 'ASC')->get();
        $barang = Barang::where('id_status', '=', '1')->orderBy('id', 'ASC')->get();
        $status = Status::all();
        $area = Area::all();



        return view('user.pages.pengajuan', compact('pengajuan', 'barang', 'status', 'area'));
    }

    public function store(Request $request)
    {
        $pengajuan = Pengajuan::create([
            'id_barang' => $request->id_barang,
            'jumlahBarang' => $request->jumlahBarang,
            'id_area' => $request->id_area,
            'required_date' => $request->required_date,
            'note' => $request->note,
            'id_status' => 5, // Automatically set id_status to 5
        ]);

        if ($pengajuan) {
            return redirect('pengajuan')->with('success', 'Data Berhasil Ditambahkan.');
        }
    }


    public function edit(Request $request)
    {
        // $request->validate([
        //     'tgl_pengembalian' => 'required',
        // ]);

        Pengajuan::where('id', $request->id)->update([
            'tgl_pengembalian' => $request->tgl_pengembalian,
        ]);

        $pengajuan = Pengajuan::find($request->id);

        $barang = Barang::find($pengajuan->id_barang);

        $updateStock = $barang->stock + $pengajuan->jumlahBarang;

        Barang::where('id', $pengajuan->id_barang)->update([
            'stock' => $updateStock
        ]);

        $barang->refresh();

        if ($barang->stock > 0) {
            Barang::where('id', $request->id_barang)->update(['id_status' => 1]);
        }

        return redirect('pengajuan')->with('success', 'Data Berhasil Diedit.');
    }


    public function delete(Request $request)
    {
        $del = Pengajuan::where('id', $request->id)->delete();

        if ($del) {
            return redirect('pengajuan')->with('success', 'Data Berhasil Dihapus.');
        }
    }

    public function index_admin()
    {
        $pengajuan = Pengajuan::orderBy('id', 'ASC')->get();
        $barang = Barang::where('id_status', '=', '1')->orderBy('id', 'ASC')->get();
        $status = Status::all();
        $pendingCount = Pengajuan::where('id_status', 5)->count();
        $area = Area::all();

        return view('pages.pengajuan', compact('pengajuan', 'barang', 'status', 'pendingCount', 'area'));
    }

    public function export()
    {
        $pengajuan = Pengajuan::orderBy('id', 'ASC')->first();
        $barang = Barang::where('id_status', '=', '1')->orderBy('id', 'ASC')->first();
        $status = Status::first();
        $area = Area::first();

        return view('export.pengajuan', compact('pengajuan', 'barang', 'status', 'area'));
    }


    public function exportFilter(Request $request)
    {
        $query = Pengajuan::query();

        if ($request->has('id_area')) {
            $query->where('id_area', $request->id_area);
        }

        if ($request->has('request_date')) {
            $query->whereDate('created_at', $request->request_date);
        }

        $pengajuan = $query->orderBy('id', 'ASC')->get();
        $barang = Barang::where('id_status', '=', '1')->orderBy('id', 'ASC')->get();
        $status = Status::get();
        $area = Area::get();

        return view('export.pengajuanFilter', compact('pengajuan', 'barang', 'status', 'area'));
    }


    public function store_admin(Request $request)
    {
        $pengajuan = Pengajuan::create([
            'id_barang' => $request->id_barang,
            'jumlahBarang' => $request->jumlahBarang,
            'id_area' => $request->id_area,
            'required_date' => $request->required_date,
            'note' => $request->note,
            'id_status' => 5, // Automatically set id_status to 5
        ]);

        if ($pengajuan) {
            return redirect('pengajuanBarang')->with('success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function edit_admin(Request $request)
    {
        $pengajuan = Pengajuan::find($request->id);

        if ($pengajuan->id_status < 6) {
            return redirect('pengajuanBarang')->with('error', 'Edit Data Failed: status has not been approved
            .');
        }

        $barang = Barang::find($pengajuan->id_barang);
        $updateStock = $barang->stock + $pengajuan->jumlahBarang;

        Pengajuan::where('id', $request->id)->update([
            'tgl_pengembalian' => $request->tgl_pengembalian,
        ]);

        Barang::where('id', $pengajuan->id_barang)->update([
            'stock' => $updateStock
        ]);

        $barang->refresh();

        Pengajuan::where('id', $request->id)->update(['id_status' => 7]);

        return redirect('pengajuanBarang')->with('success', 'Data Berhasil Diedit.');
    }


    public function delete_admin(Request $request)
    {
        $del = Pengajuan::where('id', $request->id)->delete();

        if ($del) {
            return redirect('pengajuanBarang')->with('success', 'Data Berhasil Dihapus.');
        }
    }

    public function approve($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        if ($pengajuan->id_status == 7) {
            return redirect()->back()->with('error', 'This Item is already approved.');
        }

        $barang = Barang::find($pengajuan->id_barang);
        $updateStock = $barang->stock - $pengajuan->jumlahBarang;

        if ($updateStock < 0) {
            return redirect()->back()->with('error', 'Insufficient stock.');
        }

        $pengajuan->update([
            'id_status' => 6
        ]);

        $barang->update([
            'stock' => $updateStock
        ]);

        return redirect()->back()->with('success', 'Pengajuan approved successfully.');
    }
}
