<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisiMisiFakultasController;
use App\Http\Controllers\VisiMisiInstitusiController;
use App\Http\Controllers\VisiMisiProdiController;
use App\Http\Controllers\ProfilLulusanController;
use App\Http\Controllers\CapaianProfilLulusanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/login');
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
        // VISI INSTITUSI
        Route::get('visimisiinstitusi/visi/create', [VisiMisiInstitusiController::class, 'create_visi'])->name('visiinstitusi.create_visi');
        Route::post('visimisiinstitusi/visi/store', [VisiMisiInstitusiController::class, 'store_visi'])->name('visiinstitusi.store_visi');
        Route::get('visimisiinstitusi/visi/edit/{id}', [VisiMisiInstitusiController::class, 'edit_visi'])->name('visiinstitusi.edit_visi');
        Route::put('visimisiinstitusi/visi/update/{id}', [VisiMisiInstitusiController::class, 'update_visi'])->name('visiinstitusi.update_visi');
        Route::delete('visimisiinstitusi/visi/destroy/{id}', [VisiMisiInstitusiController::class, 'hapus_visi'])->name('visiinstitusi.hapus_visi');

        // MISI INSTITUSI
        Route::get('visimisiinstitusi/misi/create', [VisiMisiInstitusiController::class, 'create_misi'])->name('visiinstitusi.create_misi');
        Route::post('visimisiinstitusi/misi/store', [VisiMisiInstitusiController::class, 'store_misi'])->name('visiinstitusi.store_misi');
        Route::get('visimisiinstitusi/misi/edit/{id}', [VisiMisiInstitusiController::class, 'edit_misi'])->name('visiinstitusi.edit_misi');
        Route::put('visimisiinstitusi/misi/update/{id}', [VisiMisiInstitusiController::class, 'update_misi'])->name('visiinstitusi.update_misi');
        Route::delete('visimisiinstitusi/misi/destroy/{id}', [VisiMisiInstitusiController::class, 'hapus_misi'])->name('visiinstitusi.hapus_misi');
    });

    // VISI MISI FAKULTAS
    Route::group(['middleware' => ['role:dekan']], function () {
        // VISI FAKULTAS
        Route::get('visimisifakultas/visi/create', [VisiMisiFakultasController::class, 'create_visi'])->name('visifakultas.create_visi');
        Route::post('visimisifakultas/visi/store', [VisiMisiFakultasController::class, 'store_visi'])->name('visifakultas.store_visi');
        Route::get('visimisifakultas/visi/edit/{id}', [VisiMisiFakultasController::class, 'edit_visi'])->name('visifakultas.edit_visi');
        Route::put('visimisifakultas/visi/update/{id}', [VisiMisiFakultasController::class, 'update_visi'])->name('visifakultas.update_visi');
        Route::delete('visimisifakultas/visi/destroy/{id}', [VisiMisiFakultasController::class, 'hapus_visi'])->name('visifakultas.hapus_visi');

        // MISI FAKULTAS
        Route::get('visimisifakultas/misi/create', [VisiMisiFakultasController::class, 'create_misi'])->name('visifakultas.create_misi');
        Route::post('visimisifakultas/misi/store', [VisiMisiFakultasController::class, 'store_misi'])->name('visifakultas.store_misi');
        Route::get('visimisifakultas/misi/edit/{id}', [VisiMisiFakultasController::class, 'edit_misi'])->name('visifakultas.edit_misi');
        Route::put('visimisifakultas/misi/update/{id}', [VisiMisiFakultasController::class, 'update_misi'])->name('visifakultas.update_misi');
        Route::delete('visimisifakultas/misi/destroy/{id}', [VisiMisiFakultasController::class, 'hapus_misi'])->name('visifakultas.hapus_misi');
    });

    // VISI MISI PRODI
    Route::group(['middleware' => ['role:kaprodi']], function () {
        // VISI PRODI
        Route::get('visimisiprodi/visi/create', [VisiMisiProdiController::class, 'create_visi'])->name('visiprodi.create_visi');
        Route::post('visimisiprodi/visi/store', [VisiMisiProdiController::class, 'store_visi'])->name('visiprodi.store_visi');
        Route::get('visimisiprodi/visi/edit/{id}', [VisiMisiProdiController::class, 'edit_visi'])->name('visiprodi.edit_visi');
        Route::put('visimisiprodi/visi/update/{id}', [VisiMisiProdiController::class, 'update_visi'])->name('visiprodi.update_visi');
        Route::delete('visimisiprodi/visi/destroy/{id}', [VisiMisiProdiController::class, 'hapus_visi'])->name('visiprodi.hapus_visi');

        // MISI PRODI
        Route::get('visimisiprodi/misi/create', [VisiMisiProdiController::class, 'create_misi'])->name('visiprodi.create_misi');
        Route::post('visimisiprodi/misi/store', [VisiMisiProdiController::class, 'store_misi'])->name('visiprodi.store_misi');
        Route::get('visimisiprodi/misi/edit/{id}', [VisiMisiProdiController::class, 'edit_misi'])->name('visiprodi.edit_misi');
        Route::put('visimisiprodi/misi/update/{id}', [VisiMisiProdiController::class, 'update_misi'])->name('visiprodi.update_misi');
        Route::delete('visimisiprodi/misi/destroy/{id}', [VisiMisiProdiController::class, 'hapus_misi'])->name('visiprodi.hapus_misi');
    });

    // PROFIL LULUSAN - Resource Route
    Route::get('profil-lulusan/get-misi/{visiId}', [ProfilLulusanController::class, 'getMisiByVisi'])->name('profil-lulusan.get-misi');

    Route::resource('profil-lulusan', ProfilLulusanController::class);
    // Tambahkan route untuk API


    // CPL - Resource Route
    Route::resource('capaian', CapaianProfilLulusanController::class);

    // Jika butuh API tambahan (misalnya ambil data CPL by Profil Lulusan)
    Route::get('capaian/by-profil/{profilId}', [CapaianProfilLulusanController::class, 'getByProfil'])
        ->name('capaian.by-profil');

});

require __DIR__ . '/auth.php';
