<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Pages Routes
Route::middleware('auth')->group(function () {

    // Peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::post('/add-peminjaman', [PeminjamanController::class, 'store']);
    Route::post('/edit-peminjaman', [PeminjamanController::class, 'edit']);
    Route::get('/delete-peminjaman/{id}', [PeminjamanController::class, 'delete']);

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

    // barang
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/add-barang', [BarangController::class, 'store']);
    Route::post('/edit-barang', [BarangController::class, 'edit']);
    Route::get('/delete-barang/{id}', [BarangController::class, 'delete']);
});
