<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pengguna\DashboardController;
use App\Http\Controllers\Pengguna\ArsipMasukController;
use App\Http\Controllers\Pengguna\ArsipKeluarController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('dashboard', [DashboardController::class, 'index'])->name('pengguna.dashboard');
Route::get('cari_arsip_masuk', [DashboardController::class, 'cariArsipMasuk'])->name('pengguna.cariArsipMasuk');
Route::get('cari_arsip_keluar', [DashboardController::class, 'cariArsipKeluar'])->name('pengguna.cariArsipKeluar');
Route::get('cari_arsip_dokumen', [DashboardController::class, 'cariArsipDokumen'])->name('pengguna.cariArsipDokumen');

Route::get('/arsip-masuk', [ArsipMasukController::class, 'index'])->name('pengguna.arsip_masuk.index');
Route::get('/arsip-masuk/{id}', [ArsipMasukController::class, 'show'])->name('pengguna.arsip_masuk.show');
// Route::get('arsip-masuk/get-bidang-by-user-opd', [ArsipMasukController::class, 'getBidangByUserOpd'])->name('pengguna.getBidangByUserOpd');

Route::get('arsip-masuk/get-bidang-by-opd/{opd_id}', [ArsipMasukController::class, 'getBidangByOpd'])->name('pengguna.getBidangByOpd');
Route::get('arsip-masuk/get-kategori-by-bidang/{bidang_id}', [ArsipMasukController::class, 'getKategoriByBidang'])->name('pengguna.getKategoriByBidang');
Route::get('arsip-masuk/get-kategori-by-opd/{opd_id}', [ArsipMasukController::class, 'getKategoriByOpd'])->name('pengguna.getKategoriByOpd');
Route::get('arsip-masuk/get-kategori-by-bidang/{bidang_id}', [ArsipMasukController::class, 'getKategoriByBidang'])->name('pengguna.getKategoriByBidang');

Route::get('arsip-keluar', [ArsipKeluarController::class, 'index'])->name('pengguna.arsip_keluar.index');
Route::get('arsip-keluar/{id}', [ArsipKeluarController::class, 'show'])->name('pengguna.arsip_keluar.show');
Route::get('arsip-keluar/get-kategori-by-bidang/{bidang_id}', [ArsipKeluarController::class, 'getKategoriByBidang'])->name('arsip_keluar.getKategoriByBidang');

Route::get('arsip-dokumen', [\App\Http\Controllers\Pengguna\ArsipDokumenController::class, 'index'])->name('pengguna.arsip_dokumen.index');
Route::get('arsip-dokumen/{id}', [\App\Http\Controllers\Pengguna\ArsipDokumenController::class, 'show'])->name('pengguna.arsip_dokumen.show');
Route::get('arsip-dokumen/get-kategori-by-bidang/{bidang_id}', [\App\Http\Controllers\Pengguna\ArsipDokumenController::class, 'getKategoriByBidang']);
