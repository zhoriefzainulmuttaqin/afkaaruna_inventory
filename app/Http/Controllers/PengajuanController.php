<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Peminjaman;
use App\Models\Status;
use App\Models\Pengajuan;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function view_user()
    {
        return view('user.pages.barang');
    }
    public function view_admin()
    {
        return view('admin.pages.barang');
    }


    public function index()
    {
        $pengajuan = Pengajuan::orderBy('id', 'ASC')->get();
        $barang = Barang::orderBy('nama', 'ASC')->get();
        $status = Status::all();
        $type = Type::all();
        $lokasi = Lokasi::all();
        $area = Area::all();
        $kategori = Kategori::all();

        return view('user.pages.pengajuan', compact('pengajuan', 'barang', 'status', 'area', 'kategori', 'type', 'lokasi'));
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
            // 'id_lokasi' => $request->id_lokasi,
            // 'id_type' => $request->id_type,

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
            'level' => $request->level,
            'id_lokasi' => $request->id_lokasi,
            'id_type' => $request->id_type,
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
                })->orWhere('level', $levelFilter); // Menambahkan kondisi OR untuk level di tabel pengajuan
            })
            ->get();
        $barang = Barang::OrderBy('nama', 'ASC')->get();

        $pendingCount = Pengajuan::where('id_status', 5)->count();
        $status = Status::all();
        $area = Area::all();
        $kategori = Kategori::all();
        $type = Type::all();
        $lokasi = Lokasi::all();

        return view('pages.pengajuan', compact('pengajuan', 'barang', 'status', 'area', 'kategori', 'pendingCount', 'type', 'lokasi'));
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
            'level' => $request->level,
            'id_lokasi' => $request->id_lokasi,
            'id_type' => $request->id_type,
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

            $query->when($request->filled('id_area'), function ($q) use ($request) {
                return $q->where('id_area', $request->input('id_area'));
            });

            $query->when($request->filled('request_date_start') && $request->filled('request_date_end'), function ($q) use ($request) {
                $tgl_masuk_awal = $request->input('request_date_start');
                $tgl_masuk_akhir = $request->input('request_date_end');
                return $q->whereBetween('request_date', [$tgl_masuk_awal, $tgl_masuk_akhir]);
            });
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
            $pengajuan = $query->orderBy('id', 'ASC')->get();

            // Ambil data yang sesuai
            $pengajuan = $query->orderBy('id', 'ASC')
                ->where('level', $levelFilter)
                 // Menambahkan kondisi OR untuk level di tabel pengajuan

                ->get();

            // Sisanya tetap sama seperti sebelumnya
            $barang = Barang::where('level', '=', $levelFilter)->where('id_status', '=', '1')->get();
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
            // 'id_lokasi' => $request->id_lokasi,
            // 'id_type' => $request->id_type,
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
                'level' => $pengajuan->level,
                'id_kategori' => $pengajuan->id_kategori,

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
