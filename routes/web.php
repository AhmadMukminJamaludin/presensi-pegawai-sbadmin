<?php

use App\Http\Controllers\BagianController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Manajemen Pegawai (hanya admin)
Route::middleware(['auth','role:admin'])->group(function() {
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('bagian', BagianController::class);
});
