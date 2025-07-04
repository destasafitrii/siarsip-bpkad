<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\PengelolaController;
use App\Http\Controllers\SuperAdmin\DataArsipController;
use App\Http\Controllers\SuperAdmin\OpdController;
use App\Http\Controllers\SuperAdmin\DataArsipMasukController;
use App\Http\Controllers\SuperAdmin\DataArsipKeluarController;
use App\Http\Controllers\SuperAdmin\DataArsipDokumenController;

Route::get('dashboard', [App\Http\Controllers\SuperAdmin\DashboardController::class, 'index'])->name('superadmin.dashboard');
Route::resource('opd', App\Http\Controllers\SuperAdmin\OpdController::class);
Route::get('/superadmin/opd/{opd}', [OpdController::class, 'show'])->name('opd.show');




Route::get('/pengelola', [PengelolaController::class, 'index'])->name('pengelola.index');
Route::post('/pengelola', [PengelolaController::class, 'store'])->name('pengelola.store');
Route::get('/pengelola/create', [PengelolaController::class, 'create'])->name('pengelola.create');
Route::get('/pengelola/{id}/edit', [PengelolaController::class, 'edit'])->name('pengelola.edit');
Route::put('/pengelola/{id}', [PengelolaController::class, 'update'])->name('pengelola.update');
Route::delete('/pengelola/{id}', [PengelolaController::class, 'destroy'])->name('pengelola.destroy');

Route::get('/data_arsip', [DataArsipController::class, 'index'])->name('data_arsip.index');
Route::get('/data_arsip/data', [DataArsipController::class, 'getData'])->name('data_arsip.data');
Route::get('/superadmin/data-arsip/{jenis}/{id}', [DataArsipController::class, 'show'])->name('data_arsip.show');

Route::get('/arsip-masuk', [DataArsipMasukController::class, 'index'])->name('superadmin.arsip_masuk.index');
Route::get('/arsip-masuk/{id}', [DataArsipMasukController::class, 'show'])->name('superadmin.arsip_masuk.show');
Route::get('master/arsip-masuk/get-bidang-by-opd/{opd_id}', [DataArsipMasukController::class, 'getBidangByOpd'])->name('superadmin.getBidangByOpd');
Route::get('master/arsip-masuk/get-kategori-by-bidang/{bidang_id}', [DataArsipMasukController::class, 'getKategoriByBidang'])->name('superadmin.getKategoriByBidang');
Route::get('master/arsip-masuk/get-kategori-by-opd/{opd_id}', [DataArsipMasukController::class, 'getKategoriByOpd'])->name('superadmin.getKategoriByOpd');

Route::get('/arsip-keluar', [DataArsipKeluarController::class, 'index'])->name('superadmin.arsip_keluar.index');
Route::get('/arsip-keluar/{id}', [DataArsipKeluarController::class, 'show'])->name('superadmin.arsip_keluar.show');
Route::get('master/arsip-keluar/get-bidang-by-opd/{opd_id}', [DataArsipKeluarController::class, 'getBidangByOpd'])->name('superadmin.getBidangByOpdKeluar');
Route::get('master/arsip-keluar/get-kategori-by-bidang/{bidang_id}', [DataArsipKeluarController::class, 'getKategoriByBidang'])->name('superadmin.getKategoriByBidangKeluar');
Route::get('master/arsip-keluar/get-kategori-by-opd/{opd_id}', [DataArsipKeluarController::class, 'getKategoriByOpd'])->name('superadmin.getKategoriByOpdKeluar');

Route::get('/arsip-dokumen', [DataArsipDokumenController::class, 'index'])->name('superadmin.arsip_dokumen.index');
Route::get('/arsip-dokumen/{id}', [DataArsipDokumenController::class, 'show'])->name('superadmin.arsip_dokumen.show');
Route::get('master/arsip-dokumen/get-bidang-by-opd/{opd_id}', [DataArsipDokumenController::class, 'getBidangByOpd'])->name('superadmin.getBidangByOpdDokumen');
Route::get('master/arsip-dokumen/get-kategori-by-bidang/{bidang_id}', [DataArsipDokumenController::class, 'getKategoriByBidang'])->name('superadmin.getKategoriByBidangDokumen');
Route::get('master/arsip-dokumen/get-kategori-by-opd/{opd_id}', [DataArsipDokumenController::class, 'getKategoriByOpd'])->name('superadmin.getKategoriByOpdDokumen');