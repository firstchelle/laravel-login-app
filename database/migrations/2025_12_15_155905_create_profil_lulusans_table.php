<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profil_lulusans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dosen_pengisi');
            $table->date('tanggal_dibuat');
            $table->string('dokumen_pendukung')->nullable();
            $table->text('profil_lulusan');
            $table->text('deskripsi_profil_lulusan');
            $table->foreignId('visi_prodi_id')->constrained('visi_prodis')->onDelete('cascade');
            $table->foreignId('misi_prodi_id')->constrained('misi_prodis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_lulusans');
    }
};
