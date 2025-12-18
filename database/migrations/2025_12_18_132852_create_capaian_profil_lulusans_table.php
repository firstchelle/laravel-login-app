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
        Schema::create('capaian_profil_lulusans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dosen_pengisi');
            $table->date('tanggal_dibuat');
            $table->string('dokumen_pendukung')->nullable();
            $table->text('capaian_profil_lulusan');
            $table->text('deskripsi_capaian_profil_lulusan');
            
            // Foreign key to profil_lulusans
            $table->foreignId('profil_lulusan_id')
                  ->constrained('profil_lulusans')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capaian_profil_lulusans');
    }
};
