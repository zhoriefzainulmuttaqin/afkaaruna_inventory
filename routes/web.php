<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WoyController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Controller\ErrorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//  Login Routes
Route::get('/', [LoginController::class, 'FormLogin']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/accesslock', [ErrorController::class, 'access']);

Route::get('//pengajuan/printPDF/', [PengajuanController::class, 'exportFilter']);
Route::post('//pengajuan/printPDF/', [PengajuanController::class, 'exportFilter']);
Route::get('//pengajuan/printPDF/{id}', [PengajuanController::class, 'export']);
Route::post('//pengajuan/printPDF/{id}', [PengajuanController::class, 'export']);
Route::get('/home-user', [WoyController::class, 'home_user']);

Route::group(['middleware' => ['auth', 'cekrole:user,admin,admin1,admin2,admin3,admin4']], function () {
    // Peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::post('/add-peminjaman', [PeminjamanController::class, 'store']);
    Route::post('/edit-peminjaman', [PeminjamanController::class, 'edit']);
    Route::get('/delete-peminjaman/{id}', [PeminjamanController::class, 'delete']);
    //woy

    // Pengajuan
    Route::get('/pengajuanBarang', [PengajuanController::class, 'index_admin']);
    Route::post('/add-pengajuanBarang', [PengajuanController::class, 'store_admin']);
    Route::post('/add-new-item', [PengajuanController::class, 'new_admin']);
    Route::post('/edit-pengajuanBarang', [PengajuanController::class, 'edit_admin']);
    Route::get('/delete-pengajuanBarang/{id}', [PengajuanController::class, 'delete_admin']);
    Route::get('approve-pengajuanBarang/{id}', [PengajuanController::class, 'approve'])->name('approve.pengajuanBarang');
    Route::get('pending-pengajuanBarang/{id}', [PengajuanController::class, 'pending'])->name('pending.pengajuanBarang');


    // Perbaikan
    Route::get('/perbaikan', [PerbaikanController::class, 'index']);
    Route::post('/add-perbaikan', [PerbaikanController::class, 'store']);
    Route::post('/edit-perbaikan', [PerbaikanController::class, 'edit']);
    Route::get('/delete-perbaikan/{id}', [PerbaikanController::class, 'delete']);

    // User
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/add-user', [UserController::class, 'store']);
    Route::post('/edit-user', [UserController::class, 'edit']);
    Route::get('/delete-user/{id}', [UserController::class, 'delete']);

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::post('/add-kategori', [KategoriController::class, 'store']);
    Route::post('/edit-kategori', [KategoriController::class, 'edit']);
    Route::get('/delete-kategori/{id}', [KategoriController::class, 'delete']);

    // Lokasi
    Route::get('/lokasi', [LokasiController::class, 'index']);
    Route::post('/add-lokasi', [LokasiController::class, 'store']);
    Route::post('/edit-lokasi', [LokasiController::class, 'edit']);
    Route::get('/delete-lokasi/{id}', [LokasiController::class, 'delete']);

    // area
    Route::get('/area', [AreaController::class, 'index']);
    Route::post('/add-area', [AreaController::class, 'store']);
    Route::post('/edit-area', [AreaController::class, 'edit']);
    Route::get('/delete-area/{id}', [AreaController::class, 'delete']);

    // type
    Route::get('/type', [TypeController::class, 'index']);
    Route::post('/add-type', [TypeController::class, 'store']);
    Route::post('/edit-type', [TypeController::class, 'edit']);
    Route::get('/delete-type/{id}', [TypeController::class, 'delete']);

    // barang
    Route::get('/barang', [BarangController::class, 'index']);
    Route::get('/barang/printpdf', [BarangController::class, 'print']);
    Route::post('/barang/printpdf', [BarangController::class, 'print']);
    Route::post('/add-barang', [BarangController::class, 'store']);
    Route::post('/edit-barang', [BarangController::class, 'edit']);
    Route::get('/delete-barang/{id}', [BarangController::class, 'delete']);

    // asset
    Route::get('/asset', [BarangController::class, 'asset']);
    Route::get('/asset/printpdf', [BarangController::class, 'print_asset']);
    Route::post('/asset/printpdf', [BarangController::class, 'print_asset']);
    Route::post('/add-asset', [BarangController::class, 'store_asset']);
    Route::post('/edit-asset', [BarangController::class, 'edit_asset']);
    Route::get('/delete-asset/{id}', [BarangController::class, 'delete_asset']);
    // });

    // Route::middleware(['auth', 'cekrole:user,superadmin'])->group(function () {
    Route::get('/pengajuan', [PengajuanController::class, 'index']);
    Route::post('/add-new_item', [PengajuanController::class, 'new']);
    Route::post('/add-pengajuan', [PengajuanController::class, 'store']);
    Route::post('/edit-pengajuan', [PengajuanController::class, 'edit']);
    Route::get('/delete-pengajuan/{id}', [PengajuanController::class, 'delete']);

    Route::get('/list_barang', [BarangController::class, 'barang_user']);
    Route::get('/list_asset', [BarangController::class, 'asset_user']);

    // Peminjaman
    Route::get('/peminjaman-barang', [PeminjamanController::class, 'index_user']);
    Route::post('/add-peminjaman-barang', [PeminjamanController::class, 'store_user']);
    Route::post('/edit-peminjaman-barang', [PeminjamanController::class, 'edit_user']);
    Route::get('/delete-peminjaman-barang/{id}', [PeminjamanController::class, 'delete_user']);
});

// Admin1
// Route::middleware(['auth', 'role:admin1'])->group(function () {
//     // Peminjaman
//     Route::get('/peminjaman', [PeminjamanController::class, 'index']);
//     Route::post('/add-peminjaman', [PeminjamanController::class, 'store']);
//     Route::post('/edit-peminjaman', [PeminjamanController::class, 'edit']);
//     Route::get('/delete-peminjaman/{id}', [PeminjamanController::class, 'delete']);

//     // Pengajuan
//     Route::get('/pengajuanBarang', [PengajuanController::class, 'index_admin']);
//     Route::post('/add-pengajuanBarang', [PengajuanController::class, 'store_admin']);
//     Route::post('/add-new-item', [PengajuanController::class, 'new_admin']);
//     Route::post('/edit-pengajuanBarang', [PengajuanController::class, 'edit_admin']);
//     Route::get('/delete-pengajuanBarang/{id}', [PengajuanController::class, 'delete_admin']);
//     Route::get('approve-pengajuanBarang/{id}', [PengajuanController::class, 'approve'])->name('approve.pengajuanBarang');
//     Route::get('pending-pengajuanBarang/{id}', [PengajuanController::class, 'pending'])->name('pending.pengajuanBarang');


//     // Perbaikan
//     Route::get('/perbaikan', [PerbaikanController::class, 'index']);
//     Route::post('/add-perbaikan', [PerbaikanController::class, 'store']);
//     Route::post('/edit-perbaikan', [PerbaikanController::class, 'edit']);
//     Route::get('/delete-perbaikan/{id}', [PerbaikanController::class, 'delete']);

//     // User
//     Route::get('/user', [UserController::class, 'index']);
//     Route::post('/add-user', [UserController::class, 'store']);
//     Route::post('/edit-user', [UserController::class, 'edit']);
//     Route::get('/delete-user/{id}', [UserController::class, 'delete']);

//     // Kategori
//     Route::get('/kategori', [KategoriController::class, 'index']);
//     Route::post('/add-kategori', [KategoriController::class, 'store']);
//     Route::post('/edit-kategori', [KategoriController::class, 'edit']);
//     Route::get('/delete-kategori/{id}', [KategoriController::class, 'delete']);

//     // Lokasi
//     Route::get('/lokasi', [LokasiController::class, 'index']);
//     Route::post('/add-lokasi', [LokasiController::class, 'store']);
//     Route::post('/edit-lokasi', [LokasiController::class, 'edit']);
//     Route::get('/delete-lokasi/{id}', [LokasiController::class, 'delete']);

//     // area
//     Route::get('/area', [AreaController::class, 'index']);
//     Route::post('/add-area', [AreaController::class, 'store']);
//     Route::post('/edit-area', [AreaController::class, 'edit']);
//     Route::get('/delete-area/{id}', [AreaController::class, 'delete']);

//     // type
//     Route::get('/type', [TypeController::class, 'index']);
//     Route::post('/add-type', [TypeController::class, 'store']);
//     Route::post('/edit-type', [TypeController::class, 'edit']);
//     Route::get('/delete-type/{id}', [TypeController::class, 'delete']);

//     // barang
//     Route::get('/barang', [BarangController::class, 'index']);
//     Route::get('/barang/printpdf', [BarangController::class, 'print']);
//     Route::post('/barang/printpdf', [BarangController::class, 'print']);
//     Route::post('/add-barang', [BarangController::class, 'store']);
//     Route::post('/edit-barang', [BarangController::class, 'edit']);
//     Route::get('/delete-barang/{id}', [BarangController::class, 'delete']);
// });

// Pages Routes
// Route::middleware('auth')->group(function () {

//     // Peminjaman
//     Route::get('/peminjaman', [PeminjamanController::class, 'index']);
//     Route::post('/add-peminjaman', [PeminjamanController::class, 'store']);
//     Route::post('/edit-peminjaman', [PeminjamanController::class, 'edit']);
//     Route::get('/delete-peminjaman/{id}', [PeminjamanController::class, 'delete']);

//     // Perbaikan
//     Route::get('/perbaikan', [PerbaikanController::class, 'index']);
//     Route::post('/add-perbaikan', [PerbaikanController::class, 'store']);
//     Route::post('/edit-perbaikan', [PerbaikanController::class, 'edit']);
//     Route::get('/delete-perbaikan/{id}', [PerbaikanController::class, 'delete']);

//     // User
//     Route::get('/user', [UserController::class, 'index']);
//     Route::post('/add-user', [UserController::class, 'store']);
//     Route::post('/edit-user', [UserController::class, 'edit']);
//     Route::get('/delete-user/{id}', [UserController::class, 'delete']);

//     // Kategori
//     Route::get('/kategori', [KategoriController::class, 'index']);
//     Route::post('/add-kategori', [KategoriController::class, 'store']);
//     Route::post('/edit-kategori', [KategoriController::class, 'edit']);
//     Route::get('/delete-kategori/{id}', [KategoriController::class, 'delete']);

//     // Lokasi
//     Route::get('/lokasi', [LokasiController::class, 'index']);
//     Route::post('/add-lokasi', [LokasiController::class, 'store']);
//     Route::post('/edit-lokasi', [LokasiController::class, 'edit']);
//     Route::get('/delete-lokasi/{id}', [LokasiController::class, 'delete']);

//     // area
//     Route::get('/area', [AreaController::class, 'index']);
//     Route::post('/add-area', [AreaController::class, 'store']);
//     Route::post('/edit-area', [AreaController::class, 'edit']);
//     Route::get('/delete-area/{id}', [AreaController::class, 'delete']);

//     // barang
//     Route::get('/barang', [BarangController::class, 'index']);
//     Route::get('/barang/printpdf', [BarangController::class, 'print']);
//     Route::post('/barang/printpdf', [BarangController::class, 'print']);
//     Route::post('/add-barang', [BarangController::class, 'store']);
//     Route::post('/edit-barang', [BarangController::class, 'edit']);
//     Route::get('/delete-barang/{id}', [BarangController::class, 'delete']);

// });
