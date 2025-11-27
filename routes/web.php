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

    // VISI INSTITUSI
    Route::get('/visiinstitusi/create', [VisiMisiInstitusiController::class, 'create'])->name('visiinstitusi.create');
    Route::post('/visiinstitusi/store', [VisiMisiInstitusiController::class, 'store'])->name('visiinstitusi.store');
    Route::get('/visiinstitusi/{id}/edit', [VisiMisiInstitusiController::class, 'edit'])->name('visiinstitusi.edit');

    // MISI INSTITUSI
    Route::get('/misiiinstitusi/create', [VisiMisiInstitusiController::class, 'create'])->name('misiiinstitusi.create');
    Route::get('/misiiinstitusi/{id}/edit', [VisiMisiInstitusiController::class, 'edit'])->name('misiiinstitusi.edit');

    // VISI FAKULTAS
    Route::get('/visifakultas/create', [VisiMisiFakultasController::class, 'create'])->name('visifakultas.create');
    Route::post('/visifakultas/store', [VisiMisiFakultasController::class, 'store'])->name('visifakultas.store');
    Route::get('/visifakultas/{id}/edit', [VisiMisiFakultasController::class, 'edit'])->name('visifakultas.edit');

    // MISI FAKULTAS
    Route::get('/misifakultas/create', [VisiMisiFakultasController::class, 'createmisi'])->name('misifakultas.create');
    Route::get('/misifakultas/{id}/edit', [VisiMisiFakultasController::class, 'editmisi'])->name('misifakultas.edit');

    // VISI PRODI
    Route::get('/visiprodi/create', [VisiMisiProdiController::class, 'create'])->name('visiprodi.create');
    Route::post('/visiprodi/store', [VisiMisiProdiController::class, 'store'])->name('visiprodi.store');
    Route::get('/visiprodi/{id}/edit', [VisiMisiProdiController::class, 'edit'])->name('visiprodi.edit');

    // MISI PRODI
    Route::get('/misiprodi/create', [VisiMisiProdiController::class, 'createmisi'])->name('misiprodi.create');
    Route::get('/misiprodi/{id}/edit', [VisiMisiProdiController::class, 'editmisi'])->name('misiprodi.edit');

    // 
});

require __DIR__ . '/auth.php';
