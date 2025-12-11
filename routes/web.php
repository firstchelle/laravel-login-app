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

    // Index routes (semua bisa read)
    Route::get('/visifakultas', [VisiMisiFakultasController::class, 'index'])->name('visifakultas.index');
    Route::get('/visiinstitusi', [VisiMisiInstitusiController::class, 'index'])->name('visiinstitusi.index');
    Route::get('/visiprodi', [VisiMisiProdiController::class, 'index'])->name('visiprodi.index');

    // API VISI MISI INSTITUSI
    Route::post('/visiinstitusi/misi/ajax-store', [VisiMisiInstitusiController::class, 'storeMisiAjax'])
        ->name('visiinstitusi.misi.ajax.store');
    Route::get('/visiinstitusi/misi/api', [VisiMisiInstitusiController::class, 'getAllMisi'])
        ->name('visiinstitusi.api.misi');

    // API VISI MISI FAKULTAS
    Route::post('/visifakultas/misi/ajax-store', [VisiMisiFakultasController::class, 'storeMisiAjax'])
        ->name('visifakultas.misi.ajax.store');
    Route::get('/visifakultas/misi/api', [VisiMisiFakultasController::class, 'getAllMisi'])
        ->name('visifakultas.api.misi');

    // API VISI MISI PRODI
    Route::post('/visiprodi/misi/ajax-store', [VisiMisiProdiController::class, 'storeMisiAjax'])
        ->name('visiprodi.misi.ajax.store');
    Route::get('/visiprodi/misi/api', [VisiMisiProdiController::class, 'getAllMisi'])
        ->name('visiprodi.api.misi');

    // VISI MISI INSTITUSI
    // Semua user login bisa create & store
    Route::get('/visiinstitusi/create', [VisiMisiInstitusiController::class, 'create'])
        ->name('visiinstitusi.create');
    Route::post('/visiinstitusi/store', [VisiMisiInstitusiController::class, 'store'])
        ->name('visiinstitusi.store');
        Route::get('/visiinstitusi/{id}/edit', [VisiMisiInstitusiController::class, 'edit'])->name('visiinstitusi.edit');
    Route::patch('/visiinstitusi/{id}/update', [VisiMisiInstitusiController::class, 'update'])->name('visiinstitusi.update');
    Route::delete('/visiinstitusi/{id}/destroy', [VisiMisiInstitusiController::class, 'destroy'])->name('visiinstitusi.destroy');
        // Route untuk Misi
    Route::get('/misi/create', [VisiMisiInstitusiController::class, 'createMisi'])->name('misiinstitusi.create');
    Route::post('/misi', [VisiMisiInstitusiController::class, 'store'])->name('misiinstitusi.store');

    Route::get('/misi/{id}/edit', [VisiMisiInstitusiController::class, 'editMisi'])->name('misiinstitusi.edit');
    Route::patch('/misi/{id}', [VisiMisiInstitusiController::class, 'updateMisi'])->name('misiinstitusi.update');
    Route::delete('/misi/{id}', [VisiMisiInstitusiController::class, 'destroyMisi'])->name('misiinstitusi.destroy');




    // VISI MISI FAKULTAS (hanya dekan)
    Route::group(['middleware' => ['role:dekan']], function () {
        Route::get('/visifakultas/create', [VisiMisiFakultasController::class, 'create'])->name('visifakultas.create');
        Route::post('/visifakultas/store', [VisiMisiFakultasController::class, 'store'])->name('visifakultas.store');
        Route::get('/visifakultas/{id}/edit', [VisiMisiFakultasController::class, 'edit'])->name('visifakultas.edit');
        Route::patch('/visifakultas/{id}/update', [VisiMisiFakultasController::class, 'update'])->name('visifakultas.update');
        Route::delete('/visifakultas/{id}/destroy', [VisiMisiFakultasController::class, 'destroy'])->name('visifakultas.destroy');
    });

    // VISI MISI PRODI (hanya kaprodi)
    Route::group(['middleware' => ['role:kaprodi']], function () {
        Route::get('/visiprodi/create', [VisiMisiProdiController::class, 'create'])->name('visiprodi.create');
        Route::post('/visiprodi/store', [VisiMisiProdiController::class, 'store'])->name('visiprodi.store');
        Route::get('/visiprodi/{id}/edit', [VisiMisiProdiController::class, 'edit'])->name('visiprodi.edit');
        Route::patch('/visiprodi/{id}/update', [VisiMisiProdiController::class, 'update'])->name('visiprodi.update');
        Route::delete('/visiprodi/{id}/destroy', [VisiMisiProdiController::class, 'destroy'])->name('visiprodi.destroy');
    });
});

require __DIR__ . '/auth.php';
