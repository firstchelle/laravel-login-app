<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('misi_institusis', function (Blueprint $table) {
            $table->id();
            $table->text('misi');
            $table->text('file_path')->nullable();
            $table->date('berlaku_sampai')->nullable();
            $table->foreignId('visi_institusi_id')->constrained('visi_institusis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('misi_institusis');
    }
};
