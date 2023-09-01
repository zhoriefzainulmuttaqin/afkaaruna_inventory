<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Status;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{

    public function index()
    {
        $pengajuan = Pengajuan::orderBy('id', 'ASC')->get();
        $barang = Barang::where('id_status', '=', '1')->orderBy('nama', 'ASC')->get();
        $status = Status::all();
        $area = Area::all();
        $kategori = Kategori::all();

        return view('user.pages.pengajuan', compact('pengajuan', 'barang', 'status', 'area', 'kategori'));
    }

    public function store(Request $request)
    {
        $pengajuan = Pengajuan::create([
            'id_barang' => $request->id_barang,
            'jumlahBarang' => $request->jumlahBarang,
            'id_area' => $request->id_area,
            'id_kategori' => $request->id_kategori,
            'required_date' => $request->required_date,
            'note' => $request->note,
            'id_status' => 5, // Automatically set id_status to 5
        ]);

        if ($pengajuan) {
            return redirect('pengajuan')->with('success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function new(Request $request)
    {
        $pengajuan = Pengajuan::create([
            'new_item' => $request->new_item,
            'jumlahBarang' => $request->jumlahBarang,
            'id_area' => $request->id_area,
            'id_kategori' => $request->id_kategori,
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
        $user = Auth::user(); // Mendapatkan informasi pengguna yang sedang login

        if ($user->role == 'admin1') {
            $levelFilter = 1;
        } elseif ($user->role == 'admin2') {
            $levelFilter = 2;
        } elseif ($user->role == 'admin3') {
            $levelFilter = 3;
        } elseif ($user->role == 'admin4') {
            $levelFilter = 4;
        } else {
            $levelFilter = null; // Tidak ada pemfilteran level jika bukan admin1-4
        }

        $pengajuan = Pengajuan::orderBy('id', 'ASC')
            ->when($levelFilter !== null, function ($query) use ($levelFilter) {
                $query->whereHas('barang', function ($subQuery) use ($levelFilter) {
                    $subQuery->where('level', $levelFilter);
                });
            })
            ->get();
        $barang = Barang::OrderBy('nama', 'ASC')->get();

        $pendingCount = Pengajuan::where('id_status', 5)->count();
        $status = Status::all();
        $area = Area::all();
        $kategori = Kategori::all();

        return view('pages.pengajuan', compact('pengajuan', 'barang', 'status', 'area', 'kategori', 'pendingCount'));
    }

    public function new_admin(Request $request)
    {
        $pengajuan = Pengajuan::create([
            'new_item' => $request->new_item,
            'jumlahBarang' => $request->jumlahBarang,
            'id_area' => $request->id_area,
            'id_kategori' => $request->id_kategori,
            'required_date' => $request->required_date,
            'note' => $request->note,
            'id_status' => 5, // Automatically set id_status to 5

        ]);

        if ($pengajuan) {
            return redirect('pengajuanBarang')->with('success', 'Data Berhasil Ditambahkan.');
        }
    }


    public function export($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $barang = $pengajuan->barang; // Assuming you have a relationship defined in your Pengajuan model
        $status = $pengajuan->status; // Assuming you have a relationship defined in your Pengajuan model
        $area = $pengajuan->area; // Assuming you have a relationship defined in your Pengajuan model

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
        $kategori = Kategori::get();
        return view('export.pengajuanFilter', compact('pengajuan', 'barang', 'status', 'area', 'kategori'));
    }


    public function store_admin(Request $request)
    {
        $pengajuan = Pengajuan::create([
            'id_barang' => $request->id_barang,
            'jumlahBarang' => $request->jumlahBarang,
            'id_kategori' => $request->id_kategori,
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

        if (!$pengajuan) {
            return redirect('pengajuanBarang')->with('error', 'Edit Data Failed: Pengajuan not found.');
        }

        if ($pengajuan->id_status < 6) {
            return redirect('pengajuanBarang')->with('error', 'Edit Data Failed: Status has not been approved.');
        }
        if ($pengajuan->id_status == 8) {
            return redirect('pengajuanBarang')->with('error', 'Edit Data Failed: Status has not been approved.');
        }

        Pengajuan::where('id', $request->id)->update([
            'tgl_pengembalian' => $request->tgl_pengembalian,
        ]);

        if ($pengajuan->id_barang) {
            $barang = Barang::find($pengajuan->id_barang);

            if (!$barang) {
                return redirect('pengajuanBarang')->with('error', 'Edit Data Failed: Barang not found.');
            }

            $updateStock = $barang->stock + $pengajuan->jumlahBarang;

            Barang::where('id', $pengajuan->id_barang)->update([
                'stock' => $updateStock
            ]);

            $barang->refresh();
        }

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

        $updateStock = $pengajuan->jumlahBarang;

        $int = random_int(100000, 200000);
        $code = "AFKAA" . $int;

        // Check if new_item is provided in the request
        if ($pengajuan->new_item) {
            // Create a new record in the Barang table
            Barang::create([
                'nama' => $pengajuan->new_item,
                'code' => $code,
                'tgl_masuk' => now(), // Use the current timestamp or the appropriate date
                'id_area' => $pengajuan->id_area,
                'stock' => $pengajuan->jumlahBarang,
            ]);
        } else {
            // Update existing Barang
            $barang = Barang::find($pengajuan->id_barang);
            if (!$barang) {
                return redirect()->back()->with('error', 'Item not found.');
            }

            $updateStock = $barang->stock - $pengajuan->jumlahBarang;

            if ($updateStock < 0) {
                return redirect()->back()->with('error', 'Insufficient stock.');
            }

            $barang->update([
                'stock' => $updateStock
            ]);
        }

        $pengajuan->update([
            'id_status' => 6
        ]);

        return redirect()->back()->with('success', 'Pengajuan approved successfully.');
    }

    public function pending($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        if ($pengajuan->id_status == 7) {
            return redirect()->back()->with('error', 'This Item is already returned.');
        }
        if ($pengajuan->id_status == 6) {
            return redirect()->back()->with('error', 'This Item is already loadned.');
        }

        $pengajuan->update([
            'id_status' => 8
        ]);

        return redirect()->back()->with('success', 'Pending Success.');
    }
}
