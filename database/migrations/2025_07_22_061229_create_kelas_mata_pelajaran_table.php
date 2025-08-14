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
        Schema::create('kelas_mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajarans')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('gurus')->onDelete('cascade'); // Guru yang mengajar
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruang_kelas')->nullable(); // Ruang kelas
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            // Pastikan tidak ada jadwal yang bentrok untuk kelas yang sama
            $table->unique(['kelas_id', 'hari', 'jam_mulai'], 'unique_jadwal_kelas');
            // Pastikan guru tidak mengajar di waktu yang sama
            $table->index(['guru_id', 'hari', 'jam_mulai'], 'idx_jadwal_guru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_mata_pelajaran');
    }
};
