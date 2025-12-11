<?php
// database/migrations/2025_01_01_000001_create_misi_institusi_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('misi_institusi', function (Blueprint $table) {
            $table->id('id_misi');
            $table->unsignedBigInteger('id_visi')->nullable();
            $table->string('isi_misi', 1500);
            $table->string('author')->nullable();
            $table->string('dokumen_pendukung')->nullable(); // <--- kolom dokumen
            $table->timestamps();

            $table->foreign('id_visi')
                  ->references('id_visi')
                  ->on('visi_institusi')
                  ->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('misi_institusi');
    }
};
