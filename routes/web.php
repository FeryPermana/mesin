<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\AdminPerbaikanController;
use App\Http\Controllers\Dashboard\AdminProduksiController;
use App\Http\Controllers\Dashboard\DowntimeController;
use App\Http\Controllers\Dashboard\ExportController;
use App\Http\Controllers\Dashboard\HarianController;
use App\Http\Controllers\Dashboard\JamKerjaController;
use App\Http\Controllers\Dashboard\JenisKegiatanController;
use App\Http\Controllers\Dashboard\JenisMesinController;
use App\Http\Controllers\Dashboard\LineproduksiController;
use App\Http\Controllers\Dashboard\LokasiController;
use App\Http\Controllers\Dashboard\MaintenanceBulananController;
use App\Http\Controllers\Dashboard\MaintenanceDowntimeController;
use App\Http\Controllers\Dashboard\MaintenanceHarianController;
use App\Http\Controllers\Dashboard\MaintenanceMingguanController;
use App\Http\Controllers\Dashboard\MesinController;
use App\Http\Controllers\Dashboard\MonitoringSuhuController;
use App\Http\Controllers\Dashboard\OperatorDowntimeController;
use App\Http\Controllers\Dashboard\PerawatanBulananController;
use App\Http\Controllers\Dashboard\PerawatanController;
use App\Http\Controllers\Dashboard\PerawatanMingguanController;
use App\Http\Controllers\Dashboard\PerbaikanOperatorController;
use App\Http\Controllers\Dashboard\PerbaikanTeknisiController;
use App\Http\Controllers\Dashboard\PresensiController;
use App\Http\Controllers\Dashboard\ProduksiController;
use App\Http\Controllers\Dashboard\ProduksiKaruController;
use App\Http\Controllers\Dashboard\RejectController;
use App\Http\Controllers\Dashboard\RejectKaruController;
use App\Http\Controllers\Dashboard\RejectOperatorControler;
use App\Http\Controllers\Dashboard\ReportPresensiController;
use App\Http\Controllers\Dashboard\ReportSuhuController;
use App\Http\Controllers\Dashboard\ShiftController;
use App\Http\Controllers\Dashboard\SparepartController;
use App\Http\Controllers\Dashboard\TeknisiDowntimeController;
use App\Http\Controllers\Dashboard\TeknisiSparepartController;
use App\Http\Controllers\Dashboard\TutorialMesinController;
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
    Route::resource('report-suhu', ReportSuhuController::class)->middleware(['auth', 'role:1']);
    Route::resource('report-presensi', ReportPresensiController::class)->middleware(['auth', 'role:1,2']);
    Route::get('/mesin/{id}/file', [MesinController::class, 'file'])->name('mesin.file')->middleware(['auth', 'role:1,2']);
    Route::put('/mesin/{id}/lesson', [MesinController::class, 'lesson'])->name('mesin.lesson')->middleware(['auth', 'role:1,2']);
    Route::put('/mesin/{id}/lessonupdate', [MesinController::class, 'lessonupdate'])->name('mesin.lessonupdate')->middleware(['auth', 'role:1,2']);
    Route::delete('/mesin/{id}/lessondelete', [MesinController::class, 'lessondelete'])->name('mesin.lessondelete')->middleware(['auth', 'role:1,2']);
    Route::resource('lokasi', LokasiController::class)->middleware(['auth', 'role:1,2']);
    Route::resource('user', UserController::class)->middleware(['auth', 'role:1,2']);
    Route::resource('shift', ShiftController::class)->middleware(['auth', 'role:1']);
    Route::resource('jamkerja', JamKerjaController::class)->middleware(['auth', 'role:1']);
    Route::resource('downtime', DowntimeController::class)->middleware(['auth', 'role:1']);
    Route::resource('jenis-kegiatan', JenisKegiatanController::class)->middleware(['auth', 'role:1']);
    Route::resource('line-produksi', LineproduksiController::class)->middleware(['auth', 'role:1']);
    Route::resource('teknisi-downtime', TeknisiDowntimeController::class)->middleware(['auth', 'role:3']);
    Route::resource('produksi', ProduksiController::class)->middleware(['auth', 'role:4']);
    Route::get('/perawatan', [PerawatanController::class, 'index'])->name('perawatan.index')->middleware(['auth', 'role:5']);
    Route::post('/perawatan', [PerawatanController::class, 'store'])->name('perawatan.store')->middleware(['auth', 'role:5']);
    Route::get('/perawatan/{id}/edit', [PerawatanController::class, 'edit'])->name('perawatan.edit')->middleware(['auth', 'role:5']);
    Route::post('/perawatan/{id}', [PerawatanController::class, 'update'])->name('perawatan.update')->middleware(['auth', 'role:5']);
    Route::get('/perawatan-mingguan', [PerawatanMingguanController::class, 'index'])->name('perawatan-mingguan.index')->middleware(['auth', 'role:3']);
    Route::post('/perawatan-mingguan', [PerawatanMingguanController::class, 'store'])->name('perawatan-mingguan.store')->middleware(['auth', 'role:3']);
    Route::get('/perawatan-bulanan', [PerawatanBulananController::class, 'index'])->name('perawatan-bulanan.index')->middleware(['auth', 'role:3']);
    Route::post('/perawatan-bulanan', [PerawatanBulananController::class, 'store'])->name('perawatan-bulanan.store')->middleware(['auth', 'role:3']);
    // Route::resource('harian', HarianController::class)->middleware(['auth', 'role:5']);
    Route::get('maintenance-harian', [MaintenanceHarianController::class, 'index'])->name('maintenance-harian.index')->middleware(['auth', 'role:1,2']);
    Route::get('maintenance-harian/{mesin_id}', [MaintenanceHarianController::class, 'show'])->name('maintenance-harian.show')->middleware(['auth', 'role:1,2']);
    Route::get('maintenance-mingguan', [MaintenanceMingguanController::class, 'index'])->name('maintenance-mingguan.index')->middleware(['auth', 'role:1,2']);
    Route::get('maintenance-mingguan/{mesin_id}', [MaintenanceMingguanController::class, 'show'])->name('maintenance-mingguan.show')->middleware(['auth', 'role:1,2']);
    Route::get('maintenance-bulanan', [MaintenanceBulananController::class, 'index'])->name('maintenance-bulanan.index')->middleware(['auth', 'role:1,2']);
    Route::get('maintenance-bulanan/{mesin_id}', [MaintenanceBulananController::class, 'show'])->name('maintenance-bulanan.show')->middleware(['auth', 'role:1,2']);
    Route::resource('maintenance-downtime', MaintenanceDowntimeController::class)->middleware(['auth', 'role:1,2']);
    Route::resource('request-perbaikan', AdminPerbaikanController::class)->middleware(['auth', 'role:1,2']);

    Route::resource('sparepart', SparepartController::class)->middleware(['auth', 'role:1']);
    Route::resource('teknisi-sparepart', TeknisiSparepartController::class)->middleware(['auth', 'role:3']);

    Route::get('/request-perbaikan-print/{id}', [AdminPerbaikanController::class, 'print'])->name('request-perbaikan.print')->middleware(['auth', 'role:1,2']);
    Route::resource('tutorial-mesin', TutorialMesinController::class)->middleware(['auth']);
    Route::resource('presensi', PresensiController::class)->middleware(['auth', 'role:3,5']);
    Route::resource('monitoring-suhu', MonitoringSuhuController::class)->middleware(['auth', 'role:5']);

    Route::resource('operator-perbaikan', PerbaikanOperatorController::class)->middleware(['auth', 'role:5']);
    Route::resource('teknisi-perbaikan', PerbaikanTeknisiController::class)->middleware(['auth', 'role:3']);

    Route::resource('produksi-karu', ProduksiKaruController::class)->except(['edit', 'update'])->middleware(['auth', 'role:4']);
    Route::get('/produksi-karu/{shift_id}/{lineproduksi_id}', [ProduksiKaruController::class, 'edit'])->name('produksi-karu.edit')->middleware(['auth', 'role:4']);
    Route::put('/produksi-karu/{shift_id}/{lineproduksi_id}', [ProduksiKaruController::class, 'update'])->name('produksi-karu.update')->middleware(['auth', 'role:4']);
    Route::resource('reject-operator', RejectOperatorControler::class)->except(['edit', 'update'])->middleware(['auth', 'role:5']);
    Route::get('/reject-operator/{mesin_id}/{shift_id}/{lineproduksi_id}', [RejectOperatorControler::class, 'edit'])->name('reject-operator.edit')->middleware(['auth', 'role:5']);
    Route::put('/reject-operator/{mesin_id}/{shift_id}/{lineproduksi_id}', [RejectOperatorControler::class, 'update'])->name('reject-operator.update')->middleware(['auth', 'role:5']);
    Route::resource('reject', RejectController::class)->middleware(['auth', 'role:1']);
    Route::resource('admin-produksi', AdminProduksiController::class)->middleware(['auth', 'role:1']);
});


Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/login', function () {
    return redirect('/');
});
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
