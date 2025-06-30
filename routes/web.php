<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Auth;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::get('/welcome', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('welcome');



Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/tambah', [BarangController::class, 'formTambah'])->name('barang.tambah');
Route::post('/barang/simpan', [BarangController::class, 'simpan'])->name('barang.simpan');
Route::get('/barang/edit/{id}', [BarangController::class, 'formEdit'])->name('barang.edit');
Route::post('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::get('/barang/hapus/{id}', [BarangController::class, 'hapus'])->name('barang.hapus');

Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
Route::post('/penjualan/simpan', [PenjualanController::class, 'simpan'])->name('penjualan.simpan');
Route::post('/penjualan/tambah-keranjang', [PenjualanController::class, 'tambahKeKeranjang'])->name('penjualan.tambahKeranjang');
Route::get('/penjualan/edit/{id}', [PenjualanController::class, 'formEdit'])->name('penjualan.edit');
Route::post('/penjualan/update/{id}', [PenjualanController::class, 'update'])->name('penjualan.update');
Route::get('/penjualan/hapus/{id}', [PenjualanController::class, 'hapus'])->name('penjualan.hapus');

// Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
// Route::get('/laporan/export',[LaporanController::class, 'export'])->name('laporan.export');
// Route::get('laporan/cetak',[LaporanController::class, 'cetak'])->name('laporan.cetak');
// Route::get('/laporan/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.exportPdf');

// Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
// Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
// Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
// Route::get('/laporan/{id}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
// Route::put('/laporan/{id}', [LaporanController::class, 'update'])->name('laporan.update');
// Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
// Route::get('/laporan/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.exportPdf');
// Menu laporan penjualan

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export');

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
