<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\KaryawanController;
use App\Http\Controllers\API\PresensiController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Presensi
    Route::get('/dashboardpresen', [PresensiController::class, 'dashboard'])->name('dashboardpresen');
    Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi');
    Route::get('/presensi/cek-absen', [PresensiController::class, 'cekAbsen'])->name('cek-absen');
    Route::get('/presensi/create', [PresensiController::class, 'create'])->name('presensi.create');
    Route::get('/presensi/edit/{id}', [PresensiController::class, 'edit'])->name('presensi.edit');
    Route::get('/presensi/destroy/{id}', [PresensiController::class, 'destroy'])->name('presensi.destroy');
    //Excelnya
    Route::get('/presensi', [PresensiController::class, 'index']);
    Route::get('/presensi/export_excelp', [PresensiController::class, 'export_excelp']);
    // Route::post('/presensi/import_excelp', [PresensiController::class, 'import_excelp']);

    //Karyawan
    Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    // Route::get('/karyawan/import', [KaryawanController::class, 'import'])->name('karyawan.import');
    Route::get('/karyawan/edit/{id}', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::get('/karyawan/destroy/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
    //Excelnya
    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::get('/karyawan/export_excel', [KaryawanController::class, 'export_excel']);
    // Route::post('/karyawan/import_excel', [KaryawanController::class, 'import_excel']);
});

require __DIR__.'/auth.php';
