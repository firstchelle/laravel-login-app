<?php
// database/migrations/2025_01_01_000000_create_visi_institusi_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('visi_institusi', function (Blueprint $table) {
            $table->id('id_visi');                          // Primary key
            $table->string('isi_visi', 1500);               // Isi visi
            $table->string('author')->nullable();           // Author
            $table->string('dokumen_pendukung')->nullable();// Path dokumen PDF
            $table->date('berlaku_sampai')->nullable();     // Tanggal berlaku
            $table->timestamps();                           // created_at & updated_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('visi_institusi');
    }
};
