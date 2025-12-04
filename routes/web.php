<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisiMisiFakultasController;
use App\Http\Controllers\VisiMisiInstitusiController;
use App\Http\Controllers\VisiMisiProdiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/visifakultas', [VisiMisiFakultasController::class, 'index'])->name('visifakultas.index');
    Route::get('/visiinstitusi', [VisiMisiInstitusiController::class, 'index'])->name('visiinstitusi.index');
    Route::get('/visiprodi', [VisiMisiProdiController::class, 'index'])->name('visiprodi.index');

    // VISI MISI INSTITUSI
    Route::get('/visiinstitusi/create', [VisiMisiInstitusiController::class, 'create'])->name('visiinstitusi.create');
    Route::post('/visiinstitusi/store', [VisiMisiInstitusiController::class, 'store'])->name('visiinstitusi.store');
    Route::get('/visiinstitusi/{id}/edit', [VisiMisiInstitusiController::class, 'edit'])->name('visiinstitusi.edit');
    Route::patch('/visiinstitusi/{id}/update', [VisiMisiInstitusiController::class, 'update'])->name('visiinstitusi.update');
    Route::delete('/visiinstitusi/{id}/destroy', [VisiMisiInstitusiController::class, 'destroy'])->name('visiinstitusi.destroy');

    // VISI FAKULTAS
    Route::get('/visifakultas/create', [VisiMisiFakultasController::class, 'create'])->name('visifakultas.create');
    Route::post('/visifakultas/store', [VisiMisiFakultasController::class, 'store'])->name('visifakultas.store');
    Route::get('/visifakultas/{id}/edit', [VisiMisiFakultasController::class, 'edit'])->name('visifakultas.edit');
    Route::patch('/visifakultas/{id}/update', [VisiMisiFakultasController::class, 'update'])->name('visifakultas.update');
    Route::delete('/visifakultas/{id}/destroy', [VisiMisiFakultasController::class, 'destroy'])->name('visifakultas.destroy');

    // VISI PRODI
    Route::get('/visiprodi/create', [VisiMisiProdiController::class, 'create'])->name('visiprodi.create');
    Route::post('/visiprodi/store', [VisiMisiProdiController::class, 'store'])->name('visiprodi.store');
    Route::get('/visiprodi/{id}/edit', [VisiMisiProdiController::class, 'edit'])->name('visiprodi.edit');
    Route::patch('/visiprodi/{id}/update', [VisiMisiProdiController::class, 'update'])->name('visiprodi.update');
    Route::delete('/visiprodi/{id}/destroy', [VisiMisiProdiController::class, 'destroy'])->name('visiprodi.destroy');
});

require __DIR__ . '/auth.php';
