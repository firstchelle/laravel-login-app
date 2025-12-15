<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisiMisiFakultasController;
use App\Http\Controllers\VisiMisiInstitusiController;
use App\Http\Controllers\VisiMisiProdiController;
use App\Http\Controllers\ProfilLulusanController;
use App\Http\Controllers\CPLController;
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

    Route::get('visimisiprodi/visi/create', [VisiMisiProdiController::class, 'create_visi'])->name('visiprodi.create_visi');
    Route::post('visimisiprodi/visi/store', [VisiMisiProdiController::class, 'store_visi'])->name('visiprodi.store_visi');
    Route::get('visimisiprodi/visi/edit/{id}', [VisiMisiProdiController::class, 'edit_visi'])->name('visiprodi.edit_visi');
    Route::put('visimisiprodi/visi/update/{id}', [VisiMisiProdiController::class, 'update_visi'])->name('visiprodi.update_visi');
    Route::delete('visimisiprodi/visi/destroy/{id}', [VisiMisiProdiController::class, 'hapus_visi'])->name('visiprodi.hapus_visi');

    Route::get('visimisiprodi/misi/create', [VisiMisiProdiController::class, 'create_misi'])->name('visiprodi.create_misi');
    Route::post('visimisiprodi/misi/store', [VisiMisiProdiController::class, 'store_misi'])->name('visiprodi.store_misi');
    Route::get('visimisiprodi/misi/edit/{id}', [VisiMisiProdiController::class, 'edit_misi'])->name('visiprodi.edit_misi');
    Route::put('visimisiprodi/misi/update/{id}', [VisiMisiProdiController::class, 'update_misi'])->name('visiprodi.update_misi');
    Route::delete('visimisiprodi/misi/destroy/{id}', [VisiMisiProdiController::class, 'hapus_misi'])->name('visiprodi.hapus_misi');

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
    Route::group(['middleware' => ['role:rektor']], function () {
        Route::get('/visiinstitusi/create', [VisiMisiInstitusiController::class, 'create'])->name('visiinstitusi.create');
        Route::post('/visiinstitusi/store', [VisiMisiInstitusiController::class, 'store'])->name('visiinstitusi.store');
        Route::get('/visiinstitusi/{id}/edit', [VisiMisiInstitusiController::class, 'edit'])->name('visiinstitusi.edit');
        Route::patch('/visiinstitusi/{id}/update', [VisiMisiInstitusiController::class, 'update'])->name('visiinstitusi.update');
        Route::delete('/visiinstitusi/{id}/destroy', [VisiMisiInstitusiController::class, 'destroy'])->name('visiinstitusi.destroy');
    });

    // VISI MISI FAKULTAS
    Route::group(['middleware' => ['role:dekan']], function () {
        Route::get('/visifakultas/create', [VisiMisiFakultasController::class, 'create'])->name('visifakultas.create');
        Route::post('/visifakultas/store', [VisiMisiFakultasController::class, 'store'])->name('visifakultas.store');
        Route::get('/visifakultas/{id}/edit', [VisiMisiFakultasController::class, 'edit'])->name('visifakultas.edit');
        Route::patch('/visifakultas/{id}/update', [VisiMisiFakultasController::class, 'update'])->name('visifakultas.update');
        Route::delete('/visifakultas/{id}/destroy', [VisiMisiFakultasController::class, 'destroy'])->name('visifakultas.destroy');
    });

    // VISI MISI PRODI
    Route::group(['middleware' => ['role:kaprodi']], function () {
        Route::get('/visiprodi/create', [VisiMisiProdiController::class, 'create'])->name('visiprodi.create');
        Route::post('/visiprodi/store', [VisiMisiProdiController::class, 'store'])->name('visiprodi.store');
        Route::get('/visiprodi/{id}/edit', [VisiMisiProdiController::class, 'edit'])->name('visiprodi.edit');
        Route::patch('/visiprodi/{id}/update', [VisiMisiProdiController::class, 'update'])->name('visiprodi.update');
        Route::delete('/visiprodi/{id}/destroy', [VisiMisiProdiController::class, 'destroy'])->name('visiprodi.destroy');
    });

    // PROFIL LULUSAN - Resource Route
    Route::get('profil-lulusan/get-misi/{visiId}', [ProfilLulusanController::class, 'getMisiByVisi'])->name('profil-lulusan.get-misi');

    Route::resource('profil-lulusan', ProfilLulusanController::class);
    // Tambahkan route untuk API


    // CPL
    Route::get('/cpl', [CPLController::class, 'index'])->name('cpl.index');
});

require __DIR__ . '/auth.php';
