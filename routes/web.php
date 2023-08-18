<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DowntimeController;
use App\Http\Controllers\Dashboard\ExportController;
use App\Http\Controllers\Dashboard\HarianController;
use App\Http\Controllers\Dashboard\JamKerjaController;
use App\Http\Controllers\Dashboard\JenisKegiatanController;
use App\Http\Controllers\Dashboard\LokasiController;
use App\Http\Controllers\Dashboard\MaintenanceBulananController;
use App\Http\Controllers\Dashboard\MaintenanceHarianController;
use App\Http\Controllers\Dashboard\MaintenanceMingguanController;
use App\Http\Controllers\Dashboard\MesinController;
use App\Http\Controllers\Dashboard\OperatorDowntimeController;
use App\Http\Controllers\Dashboard\PerawatanController;
use App\Http\Controllers\Dashboard\PerawatanMingguanController;
use App\Http\Controllers\Dashboard\ProduksiController;
use App\Http\Controllers\Dashboard\ShiftController;
use App\Http\Controllers\Dashboard\TeknisiDowntimeController;
use App\Http\Controllers\Dashboard\UserController;
use App\Models\Perawatan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/dashboard')->group(function () {
    Route::resource('mesin', MesinController::class)->middleware(['auth', 'role:1,2']);
    Route::resource('lokasi', LokasiController::class)->middleware(['auth', 'role:1,2']);
    Route::resource('user', UserController::class)->middleware(['auth', 'role:1,2']);
    Route::resource('shift', ShiftController::class)->middleware(['auth', 'role:1']);
    Route::resource('jamkerja', JamKerjaController::class)->middleware(['auth', 'role:1']);
    Route::resource('downtime', DowntimeController::class)->middleware(['auth', 'role:1']);
    Route::resource('jenis-kegiatan', JenisKegiatanController::class)->middleware(['auth', 'role:1']);
    Route::resource('teknisi-downtime', TeknisiDowntimeController::class)->middleware(['auth', 'role:3']);
    Route::resource('operator-downtime', OperatorDowntimeController::class)->middleware(['auth', 'role:5']);
    Route::resource('produksi', ProduksiController::class)->middleware(['auth', 'role:4']);
    Route::get('/perawatan', [PerawatanController::class, 'index'])->name('perawatan.index')->middleware(['auth', 'role:5']);
    Route::post('/perawatan', [PerawatanController::class, 'store'])->name('perawatan.store')->middleware(['auth', 'role:5']);
    Route::get('/perawatan-mingguan', [PerawatanMingguanController::class, 'index'])->name('perawatan-mingguan.index')->middleware(['auth', 'role:3']);;
    Route::post('/perawatan-mingguan', [PerawatanMingguanController::class, 'store'])->name('perawatan-mingguan.store')->middleware(['auth', 'role:3']);;
    // Route::resource('harian', HarianController::class)->middleware(['auth', 'role:5']);
    Route::get('maintenance-harian', [MaintenanceHarianController::class, 'index'])->name('maintenance-harian.index')->middleware(['auth', 'role:1']);
    Route::get('maintenance-harian/{mesin_id}', [MaintenanceHarianController::class, 'show'])->name('maintenance-harian.show')->middleware(['auth', 'role:1']);
    Route::get('maintenance-mingguan', [MaintenanceMingguanController::class, 'index'])->name('maintenance-mingguan.index')->middleware(['auth', 'role:1']);
    Route::get('maintenance-mingguan/{mesin_id}', [MaintenanceMingguanController::class, 'show'])->name('maintenance-mingguan.show')->middleware(['auth', 'role:1']);
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
