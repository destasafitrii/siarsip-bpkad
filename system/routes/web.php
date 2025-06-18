<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PencarianArsipSuratMasukController;
use App\Http\Controllers\PencarianArsipSuratKeluarController;
use App\Http\Controllers\frontend\PencarianController;
use App\Http\Controllers\SuperAdmin\OpdController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::get('/notif', function () {
    return view('utils.notif');
});


// Route::get('/', [PencarianController::class, 'index'])->name('pencarian');
// Route::get('/hasil-pencarian', [PencarianController::class, 'search'])->name('hasil-pencarian');
// Route::get('/arsip-masuk/{id}', [PencarianController::class, 'showMasuk'])->name('arsip.masuk.show');
// Route::get('/arsip-keluar/{id}', [PencarianController::class, 'showKeluar'])->name('arsip.keluar.show');


Route::middleware(['auth'])->group(function () {
    Route::prefix('pengelola')->middleware(['role:pengelola'])->group(function () {
        include __DIR__ . '/__/pengelola.php';
    });

    Route::prefix('superadmin')->middleware(['role:superadmin'])->group(function () {
        include __DIR__ . '/__/superadmin.php';
    });

    Route::prefix('pengguna')->middleware(['role:pengguna'])->group(function () {
        include __DIR__ . '/__/pengguna.php';
    });
});
