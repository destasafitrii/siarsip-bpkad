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
use App\Http\Controllers\ArsipImportController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\LemariController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\QrController;  
use App\Http\Controllers\ImportSuratMasukController;
use App\Http\Controllers\ImportSuratKeluarController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


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
    Route::get('/arsip_masuk/getLemariByRuangan/{ruangan_id}', 'getLemariByRuangan')->name('getLemariByRuangan');
    Route::get('/arsip_masuk/getBoxByLemari/{lemari_id}', 'getBoxByLemari')->name('getBoxByLemari');
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
     Route::get('/arsip_keluar/getLemariByRuangan/{ruangan_id}', 'getLemariByRuangan')->name('getLemariByRuangan');
    Route::get('/arsip_keluar/getBoxByLemari/{lemari_id}', 'getBoxByLemari')->name('getBoxByLemari');
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


Route::controller(RuanganController::class)->group(function () {
    Route::get('ruangan', 'index')->name('ruangan');
    Route::post('ruangan', 'store')->name('ruangan.store');
    Route::put('ruangan/{ruangan}', 'update')->name('ruangan.update');
    Route::delete('ruangan/{ruangan}', 'destroy')->name('ruangan.destroy');
});

Route::controller(LemariController::class)->group(function () {
    Route::get('lemari', 'index')->name('lemari.index');
    Route::post('lemari', 'store')->name('lemari.store');
    Route::put('lemari/{lemari}', 'update')->name('lemari.update');
    Route::delete('lemari/{lemari}', 'destroy')->name('lemari.destroy');
});

Route::get('get-lemari-by-ruangan/{id}', [LemariController::class, 'getByRuangan']);


Route::get('/get-box-by-lemari/{lemari_id}', [LemariController::class, 'getBoxByLemari']);

Route::get('/box/{id}', [QrController::class, 'tampilkanIsiBox'])->name('qr.box');

Route::controller(BoxController::class)->group(function () {
    Route::get('box', 'index')->name('box.index');
    Route::post('box', 'store')->name('box.store');
    Route::put('box/{box}', 'update')->name('box.update');
    Route::delete('box/{box}', 'destroy')->name('box.destroy');

Route::get('/cetak-qr-box/{id}',  'cetakQR')->name('box.cetakqr');

});

Route::prefix('siarsip')->controller(ImportSuratMasukController::class)->group(function () {
    Route::get('/arsip_masuk/import', 'showForm')->name('arsip_masuk.import.form');
    Route::post('/arsip_masuk/import/preview', 'preview')->name('arsip_masuk.import.preview');
    Route::post('/arsip_masuk/import/save', 'save')->name('arsip_masuk.import.save');
});



Route::prefix('siarsip')->controller(ImportSuratKeluarController::class)->group(function () {
    Route::get('/arsip_keluar/import', 'showForm')->name('arsip_keluar.import.form');
    Route::post('/arsip_keluar/import/preview', 'preview')->name('arsip_keluar.import.preview');
    Route::post('/arsip_keluar/import/save', 'save')->name('arsip_keluar.import.save');
});
