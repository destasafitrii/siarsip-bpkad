<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipController;

Route::get('/', function () {
    return view('content.index');
});

Route::controller(ArsipController::class)->group(function () {
    Route::get('/arsip', 'index')->name('arsip.index');
    Route::get('/arsip/create', 'create')->name('arsip.create');
    Route::post('/arsip', 'store')->name('arsip.store');
    Route::get('/arsip/{arsip}/edit', 'edit')->name('arsip.edit');
    Route::put('/arsip/{arsip}', 'update')->name('arsip.update');
    Route::delete('/arsip/{arsip}', 'destroy')->name('arsip.destroy');
});

Route::get('/notif', function () {
    return view('utils.notif');
});