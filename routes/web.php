<?php

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
Route::get('/login', function () {
    return view('login/login');
});

Route::get('/signup', function () {
    return view('login/signup');
});

// Pages Routes

Route::get('/admin', function () {
    return view('home');
});

Route::get('/peminjaman', function () {
    return view('home');
});

Route::get('/barang', function () {
    return view('pages/barang');
});
