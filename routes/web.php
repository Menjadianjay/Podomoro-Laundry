<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\LaundryController;


// Home page routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/tentang', [HomeController::class, 'tentang']);
Route::get('/layanan', [HomeController::class, 'layanan']);
Route::get('/kontak', [HomeController::class, 'kontak']);

// Login routes
Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('admin/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// Staff
// Staff page routes
Route::get('/pegawai/dashboard', [PegawaiController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('pegawai.dashboard');
Route::get('/pegawai/inputdata', [PegawaiController::class, 'inputdata'])->middleware(['auth', 'verified']);
Route::post('/pegawai/inputdata', [PegawaiController::class, 'store'])->middleware(['auth', 'verified'])->name('pegawai.store');
Route::get('pegawai/viewdata', [PegawaiController::class, 'viewdata'])->middleware(['auth', 'verified'])->name('pegawai.viewdata');
Route::get('pegawai/editdata/{id}', [PegawaiController::class, 'editdata'])->middleware(['auth', 'verified'])->name('pegawai.editdata');
Route::put('pegawai/update/{id}', [PegawaiController::class, 'update'])->middleware(['auth', 'verified'])->name('pegawai.update');
Route::delete('pegawai/delete/{id}', [PegawaiController::class, 'delete'])->middleware(['auth', 'verified'])->name('pegawai.delete');

// Staff attendance
// Display the attendance list
Route::get('/pegawai/presensi', [PresensiController::class, 'presensi'])->middleware(['auth', 'verified'])->name('pegawai.presensi');

// Display the attendance entry form
Route::get('/presensi/create', [PresensiController::class, 'presensi'])->middleware(['auth', 'verified'])->name('presensi.create');

// Save attendance data
Route::post('/presensi', [PresensiController::class, 'store'])->middleware(['auth', 'verified'])->name('presensi.store');

// Display the attendance list on the staff dashboard
Route::get('/pegawai/viewpresensi', [PresensiController::class, 'viewpresensi'])->middleware(['auth', 'verified'])->name('pegawai.viewpresensi');

// Route for viewing the uploaded file
Route::get('/presensi/{id}/file', [PresensiController::class, 'showFile'])->name('presensi.file');
// Set the staff attendance time limit
//Route::post('pegawai/presensi', [PresensiController::class, 'waktupresensi'])->middleware(['auth', 'verified'])->name('pegawai.presensi');

// Manager
Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('manager.dashboard');
Route::get('/manager/inputdata', [ManagerController::class, 'inputdata'])->middleware(['auth', 'verified']);
Route::post('/manager/inputdata', [ManagerController::class, 'store'])->middleware(['auth', 'verified'])->name('manager.store');
Route::get('manager/viewdata', [ManagerController::class, 'viewdata'])->middleware(['auth', 'verified'])->name('manager.viewdata');
Route::get('manager/editdata/{id}', [ManagerController::class, 'editdata'])->middleware(['auth', 'verified'])->name('manager.editdata');
Route::put('manager/update/{id}', [ManagerController::class, 'update'])->middleware(['auth', 'verified'])->name('manager.update');
Route::delete('manager/delete/{id}', [ManagerController::class, 'delete'])->middleware(['auth', 'verified'])->name('manager.delete');
// Display the attendance list on the manager dashboard
// Display the attendance list
Route::get('/manager/presensi', [PresensiController::class, 'presensimanager'])->middleware(['auth', 'verified'])->name('manager.presensi');

// Display the attendance entry form
Route::get('/presensi/create', [PresensiController::class, 'presensi'])->middleware(['auth', 'verified'])->name('presensi.create');

// Save attendance data
Route::post('/presensi', [PresensiController::class, 'store'])->middleware(['auth', 'verified'])->name('presensi.store');

Route::get('manager/viewpresensi', [PresensiController::class, 'viewpresensiManager'])->middleware(['auth', 'verified'])->name('manager.viewpresensi');

Route::get('/presensi/{id}/edit', [PresensiController::class, 'editpresensi'])->middleware(['auth', 'verified'])->name('presensi.edit');
Route::put('/presensi/{id}', [PresensiController::class, 'update'])->middleware(['auth', 'verified'])->name('presensi.update');
Route::delete('/presensi/{id}', [PresensiController::class, 'destroy'])->middleware(['auth', 'verified'])->name('presensi.destroy');

Route::get('/manager/inputlayanan', [LaundryController::class, 'create'])->name('manager.inputlayanan');
Route::post('/manager/inputlayanan', [LaundryController::class, 'store'])->name('manager.storelayanan');
Route::get('manager/editlayanan/{id}', [LaundryController::class, 'edit'])->name('manager.editlayanan');
Route::put('manager/updatelayanan/{id}', [LaundryController::class, 'update'])->name('manager.updatelayanan');
Route::get('/manager/viewlayanan', [LaundryController::class, 'viewlayanan'])->name('manager.viewlayanan');
Route::delete('/manager/laundries/{id}', [LaundryController::class, 'destroy'])->name('manager.deletelayanan');
Route::delete('/manager/laundries/{id}', [LaundryController::class, 'destroy'])->name('manager.deletelayanan');

Route::get('/layanan', [LaundryController::class, 'viewlandinglayanan'])->name('layanan');
Route::put('/layanan', [LaundryController::class, 'viewlandinglayanan'])->name('layanan');
