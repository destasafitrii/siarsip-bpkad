<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\PengelolaController;
use App\Http\Controllers\SuperAdmin\DataArsipController;

Route::get('dashboard', [App\Http\Controllers\SuperAdmin\DashboardController::class, 'index'])->name('superadmin.dashboard');
Route::resource('opd', App\Http\Controllers\SuperAdmin\OpdController::class);



Route::get('/pengelola', [PengelolaController::class, 'index'])->name('pengelola.index');
Route::post('/pengelola', [PengelolaController::class, 'store'])->name('pengelola.store');
Route::get('/pengelola/create', [PengelolaController::class, 'create'])->name('pengelola.create');
Route::get('/pengelola/{id}/edit', [PengelolaController::class, 'edit'])->name('pengelola.edit');
Route::put('/pengelola/{id}', [PengelolaController::class, 'update'])->name('pengelola.update');
Route::delete('/pengelola/{id}', [PengelolaController::class, 'destroy'])->name('pengelola.destroy');

Route::get('/data_arsip', [DataArsipController::class, 'index'])->name('data_arsip.index');
Route::get('/data_arsip/data', [DataArsipController::class, 'getData'])->name('data_arsip.data');
