<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// ...

// Menampilkan formulir tambah pelanggan
Route::get('/pelanggan/add', [PelangganController::class, 'add']);

// Menyimpan data pelanggan baru
Route::post('/pelanggan/store', [PelangganController::class, 'store']);

// Menampilkan halaman index pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');

// Menampilkan formulir edit pelanggan
Route::get('/pelanggan/edit/{id}', [PelangganController::class, 'edit']);

// Memperbarui data pelanggan
Route::put('/pelanggan/update/{id}', [PelangganController::class, 'update']);

// Menghapus data pelanggan
Route::delete('/pelanggan/delete/{id}', [PelangganController::class, 'delete']);

// Menampilkan halaman pencarian pelanggan
Route::get('/pelanggan/search', [PelangganController::class, 'search']);


Route::get('/pesanan', [PesananController::class, 'index'])->name('pelanggan.index');
Route::get('/pesanan/add', [PesananController::class, 'add']);
Route::post('/pesanan/store', [PesananController::class, 'store']);
Route::get('/pesanan/edit/{id}', [PesananController::class, 'edit']);
Route::post('/pesanan/update/{id}', [PesananController::class, 'update']);
Route::get('/pesanan/delete/{id}', [PesananController::class, 'delete']);
Route::post('/pesanan/search', [PesananController::class, 'search']);

Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/add', [ProdukController::class, 'add'])->name('produk.add');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
Route::post('/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::get('/produk/delete/{id}', [ProdukController::class, 'delete'])->name('produk.delete');
Route::post('/produk/search', [ProdukController::class, 'search'])->name('produk.search');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');

Route::post('/pelanggan/restore/{id}', [PelangganController::class, 'restore']);
Route::post('/pesanan/restore/{id}', [PesananController::class, 'restore']);
Route::post('/produk/restore/{id}', [ProdukController::class, 'restore']);