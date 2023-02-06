<?php

use App\Http\Controllers\LoginController;
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
Route::post('/login', [LoginController::class, 'login']);

// Pages Routes
Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('home');
    });

    Route::get('/peminjaman', function () {
        return view('home');
    });

    Route::get('/barang', function () {
        return view('pages/barang');
    });

    Route::get('/perbaikan', function () {
        return view('pages/perbaikan');
    });

    Route::get('/kategori', function () {
        return view('pages/kategori');
    });
});
