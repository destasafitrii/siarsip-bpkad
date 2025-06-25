<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pengguna\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('dashboard', [DashboardController::class, 'index'])->name('pengguna.dashboard');
Route::get('cari_arsip_masuk', [DashboardController::class, 'cariArsipMasuk'])->name('pengguna.cariArsipMasuk');
Route::get('cari_arsip_keluar', [DashboardController::class, 'cariArsipKeluar'])->name('pengguna.cariArsipKeluar');
Route::get('cari_arsip_dokumen', [DashboardController::class, 'cariArsipDokumen'])->name('pengguna.cariArsipDokumen');