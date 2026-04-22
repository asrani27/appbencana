<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Login Routes
Route::get('/invoice', function () {
    return view('invoice');
});
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // User Management Routes
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    // Bencana Management Routes
    Route::resource('bencana', \App\Http\Controllers\Admin\BencanaController::class);

    // Korban Management Routes
    Route::resource('korban', \App\Http\Controllers\Admin\VictimController::class);

    // Triase Management Routes
    Route::resource('triase', \App\Http\Controllers\Admin\TriaseController::class);

    // Pemeriksaan Medis Management Routes
    Route::resource('pemeriksaan', \App\Http\Controllers\Admin\PemeriksaanController::class);

    // Rujukan Management Routes
    Route::resource('rujukan', \App\Http\Controllers\Admin\RujukanController::class);

    // Rumah Sakit Management Routes
    Route::resource('rumahsakit', \App\Http\Controllers\Admin\RumahSakitController::class);

    // Laporan Routes
    Route::get('/laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/bencana', [\App\Http\Controllers\Admin\LaporanController::class, 'bencanaIndex'])->name('laporan.bencana');
    Route::get('/laporan/korban', [\App\Http\Controllers\Admin\LaporanController::class, 'korbanIndex'])->name('laporan.korban');
    Route::get('/laporan/triase', [\App\Http\Controllers\Admin\LaporanController::class, 'triaseIndex'])->name('laporan.triase');
    Route::get('/laporan/pemeriksaan', [\App\Http\Controllers\Admin\LaporanController::class, 'pemeriksaanIndex'])->name('laporan.pemeriksaan');
    Route::get('/laporan/rujukan', [\App\Http\Controllers\Admin\LaporanController::class, 'rujukanIndex'])->name('laporan.rujukan');
    Route::get('/laporan/rumahsakit', [\App\Http\Controllers\Admin\LaporanController::class, 'rumahSakitIndex'])->name('laporan.rumahsakit');

    // API Dokumentasi Routes
    Route::get('/api-docs', [\App\Http\Controllers\Admin\ApiDocsController::class, 'index'])->name('api-docs');
});
