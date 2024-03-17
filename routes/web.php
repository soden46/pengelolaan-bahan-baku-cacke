<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataBarangKeluarController;
use App\Http\Controllers\DataBarangMasukController;
use App\Http\Controllers\GetBarangController;
use App\Http\Controllers\GetDataBarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanBarangKeluarController;
use App\Http\Controllers\LaporanBarangMasukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanStokBarangController;
use App\Models\barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();


//Data BARANG
Route::get('/data-barang', [DataBarangController::class, 'barangIndex'])->name('data-barang/index');
Route::get('/data-barang/create', [DataBarangController::class, 'barangCreate'])->name('data-barang/create');
Route::get('/data-barang/edit/{kode_barang}', [DataBarangController::class, 'barangEdit'])->name('data-barang/edit');
Route::post('/data-barang/create/store', [DataBarangController::class, 'barangCreatePost'])->name('data-barang/create/store');
Route::post('/data-barang/edit/post/{kode_barang}', [DataBarangController::class, 'barangEditPost'])->name('data-barang/edit/post');
Route::post('/data-barang/hapus/{kode_barang}', [DataBarangController::class, 'barangHapus'])->name('data-barang/hapus');

//Barang Keluar
Route::get('/barang-keluar', [DataBarangKeluarController::class, 'Index'])->name('barang-keluar/index');
Route::get('/barang-keluar/detail/{keluar}', [DataBarangKeluarController::class, 'Detail'])->name('barang-keluar/detail');
Route::get('/barang-keluar/create', [DataBarangKeluarController::class, 'Create'])->name('barang-keluar/create');
Route::post('/barang-keluar/create/post', [DataBarangKeluarController::class, 'CreatePost'])->name('barang-keluar/create/post');
Route::get('/barang-keluar/edit/{id_barang_keluar}', [DataBarangKeluarController::class, 'Edit'])->name('barang-keluar/edit');
Route::post('/barang-keluar/edit/post/{id_barang_keluar}', [DataBarangKeluarController::class, 'EditPost'])->name('barang-keluar/edit/post');
Route::post('/barang-keluar/hapus/{id_barang_keluar}', [DataBarangKeluarController::class, 'Hapus'])->name('barang-keluar/hapus');

// Barang Masuk
Route::get('/barang-masuk', [DataBarangMasukController::class, 'Index'])->name('barang-masuk/index');
Route::get('/barang-masuk/detail/{id_detail_barang_masuk}', [DataBarangMasukController::class, 'Detail'])->name('barang-masuk/detail');
Route::get('/barang-masuk/create', [DataBarangMasukController::class, 'Create'])->name('barang-masuk/create');
Route::get('/barang-masuk/edit/{id_barang_masuk}', [DataBarangMasukController::class, 'Edit'])->name('barang-masuk/edit');
Route::post('/barang-masuk/create/post', [DataBarangMasukController::class, 'CreatePost'])->name('barang-masuk/create/post');
Route::post('/barang-masuk/edit/post/{id_barang_masuk}', [DataBarangMasukController::class, 'EditPost'])->name('barang-masuk/edit/post');
Route::post('/barang-masuk/hapus/{id_barang_masuk}', [DataBarangMasukController::class, 'Hapus'])->name('barang-masuk/hapus');

// Kategori
Route::get('/kategori', [KategoriController::class, 'Index'])->name('kategori/index');
Route::get('/kategori/create', [KategoriController::class, 'Create'])->name('kategori/create');
Route::get('/kategori/edit/{id_kategori}', [KategoriController::class, 'Edit'])->name('kategori/edit');
Route::post('/kategori/create/post', [KategoriController::class, 'CreatePost'])->name('kategori/create/post');
Route::post('/kategori/edit/post/{id_kategori}', [KategoriController::class, 'EditPost'])->name('kategori/edit/post');
Route::post('/kategori/hapus/{id_kategori}', [KategoriController::class, 'Hapus'])->name('kategori/hapus');

// Laporan
Route::get('/laporan', [LaporanController::class, 'Index'])->name('laporan')->middleware('auth');
Route::get('/laporan/pdf', [LaporanController::class, 'PDF'])->name('laporan/pdf')->middleware('auth');
// Laporan Stok
Route::get('/laporan/stok/', [LaporanStokBarangController::class, 'Index'])->name('laporan/stok')->middleware('auth');
Route::get('/laporan/stok/pdf', [LaporanStokBarangController::class, 'PDF'])->name('laporan/stok/pdf')->middleware('auth');

Route::get('/getBarang/{id}', [GetDataBarangController::class, 'getNamaBarang']);
Route::get('/getBarangNama/{id}', [GetDataBarangController::class, 'getBarangNama']);
