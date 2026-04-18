<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group.
|
*/

// Auth Routes (Public)
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login'])->name('api.login');

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth Routes
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->name('api.logout');
    Route::get('/user', [\App\Http\Controllers\Api\AuthController::class, 'user'])->name('api.user');

    // Bencana Routes
    Route::get('/bencana', [\App\Http\Controllers\Api\BencanaController::class, 'index'])->name('api.bencana.index');
    Route::post('/bencana', [\App\Http\Controllers\Api\BencanaController::class, 'store'])->name('api.bencana.store');
    Route::get('/bencana/{id}', [\App\Http\Controllers\Api\BencanaController::class, 'show'])->name('api.bencana.show');
    Route::put('/bencana/{id}', [\App\Http\Controllers\Api\BencanaController::class, 'update'])->name('api.bencana.update');
    Route::delete('/bencana/{id}', [\App\Http\Controllers\Api\BencanaController::class, 'destroy'])->name('api.bencana.destroy');

    // Korban Routes
    Route::get('/korban', [\App\Http\Controllers\Api\KorbanController::class, 'index'])->name('api.korban.index');
    Route::post('/korban', [\App\Http\Controllers\Api\KorbanController::class, 'store'])->name('api.korban.store');
    Route::get('/korban/{id}', [\App\Http\Controllers\Api\KorbanController::class, 'show'])->name('api.korban.show');
    Route::put('/korban/{id}', [\App\Http\Controllers\Api\KorbanController::class, 'update'])->name('api.korban.update');
    Route::delete('/korban/{id}', [\App\Http\Controllers\Api\KorbanController::class, 'destroy'])->name('api.korban.destroy');

    // Triase Routes
    Route::get('/triase', [\App\Http\Controllers\Api\TriaseController::class, 'index'])->name('api.triase.index');
    Route::post('/triase', [\App\Http\Controllers\Api\TriaseController::class, 'store'])->name('api.triase.store');
    Route::get('/triase/{id}', [\App\Http\Controllers\Api\TriaseController::class, 'show'])->name('api.triase.show');
    Route::put('/triase/{id}', [\App\Http\Controllers\Api\TriaseController::class, 'update'])->name('api.triase.update');
    Route::delete('/triase/{id}', [\App\Http\Controllers\Api\TriaseController::class, 'destroy'])->name('api.triase.destroy');

    // Pemeriksaan Routes
    Route::get('/pemeriksaan', [\App\Http\Controllers\Api\PemeriksaanController::class, 'index'])->name('api.pemeriksaan.index');
    Route::post('/pemeriksaan', [\App\Http\Controllers\Api\PemeriksaanController::class, 'store'])->name('api.pemeriksaan.store');
    Route::get('/pemeriksaan/{id}', [\App\Http\Controllers\Api\PemeriksaanController::class, 'show'])->name('api.pemeriksaan.show');
    Route::put('/pemeriksaan/{id}', [\App\Http\Controllers\Api\PemeriksaanController::class, 'update'])->name('api.pemeriksaan.update');
    Route::delete('/pemeriksaan/{id}', [\App\Http\Controllers\Api\PemeriksaanController::class, 'destroy'])->name('api.pemeriksaan.destroy');

    // Rujukan Routes
    Route::get('/rujukan', [\App\Http\Controllers\Api\RujukanController::class, 'index'])->name('api.rujukan.index');
    Route::post('/rujukan', [\App\Http\Controllers\Api\RujukanController::class, 'store'])->name('api.rujukan.store');
    Route::get('/rujukan/{id}', [\App\Http\Controllers\Api\RujukanController::class, 'show'])->name('api.rujukan.show');
    Route::put('/rujukan/{id}', [\App\Http\Controllers\Api\RujukanController::class, 'update'])->name('api.rujukan.update');
    Route::delete('/rujukan/{id}', [\App\Http\Controllers\Api\RujukanController::class, 'destroy'])->name('api.rujukan.destroy');

    // Rumah Sakit Routes
    Route::get('/rumah-sakit', [\App\Http\Controllers\Api\RumahSakitController::class, 'index'])->name('api.rumahsakit.index');
    Route::post('/rumah-sakit', [\App\Http\Controllers\Api\RumahSakitController::class, 'store'])->name('api.rumahsakit.store');
    Route::get('/rumah-sakit/{id}', [\App\Http\Controllers\Api\RumahSakitController::class, 'show'])->name('api.rumahsakit.show');
    Route::put('/rumah-sakit/{id}', [\App\Http\Controllers\Api\RumahSakitController::class, 'update'])->name('api.rumahsakit.update');
    Route::delete('/rumah-sakit/{id}', [\App\Http\Controllers\Api\RumahSakitController::class, 'destroy'])->name('api.rumahsakit.destroy');
    Route::get('/rumah-sakit/nearby', [\App\Http\Controllers\Api\RumahSakitController::class, 'nearby'])->name('api.rumahsakit.nearby');
});
