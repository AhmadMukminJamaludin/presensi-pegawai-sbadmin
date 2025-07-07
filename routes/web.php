<?php

use App\Http\Controllers\BagianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('bagian', BagianController::class);
    Route::get('laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('pengaturan', PengaturanController::class)
        ->only(['index', 'edit', 'update']);
    Route::get('laporan/export', [LaporanController::class, 'export'])
        ->name('laporan.export')
        ->middleware(['auth', 'role:admin']);
});

Route::middleware(['auth', 'role:pegawai|admin'])->group(function () {
    Route::resource('presensi', PresensiController::class)
        ->only(['index', 'store', 'update'])
        ->names(['index' => 'presensi.index', 'store' => 'presensi.store', 'update' => 'presensi.update']);
});
Route::middleware(['auth', 'role:pegawai'])->group(function () {
    Route::get('dashboard-pegawai', [DashboardController::class, 'indexPegawai'])->name('pegawai.dashboard');
});
