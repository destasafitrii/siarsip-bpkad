<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipSuratMasukController;
use App\Http\Controllers\ArsipSuratKeluarController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\LemariController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\ImportSuratMasukController;
use App\Http\Controllers\ImportSuratKeluarController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArsipDokumenController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('pengelola.dashboard');

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
    Route::put('kategori/{kategori}', 'update')->name('kategori.update');
    Route::delete('kategori/{kategori}', 'destroy')->name( 'kategori.destroy');

    // Menambahkan route untuk mendapatkan kategori berdasarkan bidang

});
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
Route::get('pengguna', [App\Http\Controllers\PenggunaController::class, 'index'])->name('pengguna.index');
Route::get('pengguna/create', [App\Http\Controllers\PenggunaController::class, 'create'])->name('pengguna.create');
Route::post('pengguna', [App\Http\Controllers\PenggunaController::class, 'store'])->name('pengguna.store');
Route::get('pengguna/{id}/edit', [App\Http\Controllers\PenggunaController::class, 'edit'])->name('pengguna.edit');
Route::put('pengguna/{id}', [App\Http\Controllers\PenggunaController::class, 'update'])->name('pengguna.update');
Route::delete('pengguna/{id}', [App\Http\Controllers\PenggunaController::class, 'destroy'])->name('pengguna.destroy');



Route::controller(ArsipDokumenController::class)->group(function () {
    Route::get('arsip_dokumen', 'index')->name('arsip_dokumen.index'); // HARUS DI ATAS
    Route::get('arsip_dokumen/create', 'create')->name('arsip_dokumen.create');
    Route::post('arsip_dokumen', 'store')->name('arsip_dokumen.store');
    Route::get('arsip_dokumen/{arsip_dokumen}/edit', 'edit')->name('arsip_dokumen.edit');
    Route::put('arsip_dokumen/{arsip_dokumen}', 'update')->name('arsip_dokumen.update');
    Route::delete('arsip_dokumen/{arsip_dokumen}', 'destroy')->name('arsip_dokumen.destroy');

    // 🛑 Route ini HARUS PALING BAWAH
    Route::get('arsip_dokumen/{arsip_dokumen}', 'show')->name('arsip_dokumen.show');

    Route::delete('/{id}', [ArsipDokumenController::class, 'destroy'])->name('destroy');
    Route::get('arsip_dokumen/getKategoriByBidang/{bidang_id}', [App\Http\Controllers\ArsipDokumenController::class, 'getKategoriByBidang']);
    Route::get('arsip_dokumen/getLemariByRuangan/{ruangan_id}', [App\Http\Controllers\ArsipDokumenController::class, 'getLemariByRuangan']);
    Route::get('arsip_dokumen/getBoxByLemari/{lemari_id}', [App\Http\Controllers\ArsipDokumenController::class, 'getBoxByLemari']);
});
