<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipSuratMasukController;
use App\Http\Controllers\ArsipSuratKeluarController;
use App\Http\Controllers\PencarianArsipController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PencarianArsipSuratMasukController;
use App\Http\Controllers\PencarianArsipSuratKeluarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\frontend\PencarianController;
Route::get('dashboard', function () {
    return view('backend.index');
});


Route::get('/notif', function () {
    return view('utils.notif');
});
Route::controller(ArsipSuratMasukController::class)->group(function () {
    Route::get('arsip_masuk', 'index')->name('arsip_masuk.index');
    Route::get('arsip_masuk/create', 'create')->name('arsip_masuk.create');
    Route::post('arsip_masuk', 'store')->name('arsip_masuk.store');
    Route::get('arsip_masuk/{arsip_masuk}/edit', 'edit')->name('arsip_masuk.edit');
    Route::put('arsip_masuk/{arsip_masuk}', 'update')->name('arsip_masuk.update');
    Route::delete('arsip_masuk/{arsip_masuk}', 'destroy')->name('arsip_masuk.destroy');
    Route::get('arsip_masuk/{arsip_masuk}', 'show')->name('arsip_masuk.show');
    Route::get('/arsip_masuk/getKategoriByBidang/{bidang_id}', 'getKategoriByBidang')->name('getKategoriByBidang');
});

Route::controller(ArsipSuratKeluarController::class)->group(function () {
    Route::get('arsip_keluar', 'index')->name('arsip_keluar.index');
    Route::get('arsip_keluar/create', 'create')->name('arsip_keluar.create');
    Route::post('arsip_keluar', 'store')->name('arsip_keluar.store');
    Route::get('arsip_keluar/{arsip_keluar}/edit', 'edit')->name('arsip_keluar.edit');
    Route::put('arsip_keluar/{arsip_keluar}', 'update')->name('arsip_keluar.update');
    Route::delete('arsip_keluar/{arsip_keluar}', 'destroy')->name('arsip_keluar.destroy');
    Route::get('arsip_keluar/{arsip_keluar}', 'show')->name('arsip_keluar.show');
    Route::get('/arsip_keluar/getKategoriByBidang/{bidang_id}', 'getKategoriByBidang')->name('getKategoriByBidang');
});




Route::controller(BidangController::class)->group(function () {
    Route::get('bidang', 'index')->name('bidang.index');
    Route::get('bidang/create', 'create')->name('bidang.create');
    Route::post('bidang', 'store')->name('bidang.store');
    Route::get('bidang/{bidang}/edit', 'edit')->name('bidang.edit');
    Route::put('bidang/{bidang}', 'update')->name('bidang.update');
    Route::delete('bidang/{bidang}', 'destroy')->name('bidang.destroy');
});


// In your routes/web.php
Route::controller(KategoriController::class)->group(function () {
    Route::get('kategori', 'index');
    Route::post('kategori', 'store')->name('kategori.store');
    Route::get('kategori/{kategori}/edit', 'edit');
    Route::put('kategori/{kategori}/edit', 'update')->name('kategori.update');
    Route::get('kategori/{kategori}/delete', 'destroy');
    
    // Menambahkan route untuk mendapatkan kategori berdasarkan bidang
    
});

Route::controller(PencarianArsipSuratMasukController::class)->group(function () {
    Route::get('pencarian-arsip-masuk', 'index')->name('pencarian-arsip-masuk');
    Route::get('/kategoris/bidang/{bidang_id}', 'getKategorisByBidang');
});

Route::controller(PencarianArsipSuratKeluarController::class)->group(function () {
    Route::get('pencarian-arsip-keluar', 'index')->name('pencarian-arsip-keluar');
    Route::get('/kategoris/bidang/{bidang_id}', 'getKategorisByBidang');
});



Route::get('/', [PencarianController::class, 'index'])->name('pencarian');
Route::get('/hasil-pencarian', [PencarianController::class, 'search'])->name('hasil-pencarian');
Route::get('/arsip-masuk/{id}', [PencarianController::class, 'showMasuk'])->name('arsip.masuk.show');
Route::get('/arsip-keluar/{id}', [PencarianController::class, 'showKeluar'])->name('arsip.keluar.show');


