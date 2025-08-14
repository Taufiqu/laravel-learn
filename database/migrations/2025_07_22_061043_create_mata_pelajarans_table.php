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
        Schema::create('mata_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mata_pelajaran')->unique(); // Nama mata pelajaran
            $table->string('kode_mata_pelajaran')->unique(); // Kode mata pelajaran (contoh: MAT, IPA, ING)
            $table->text('deskripsi')->nullable(); // Deskripsi mata pelajaran
            $table->enum('kategori', ['Wajib', 'Pilihan', 'Muatan Lokal'])->default('Wajib');
            $table->integer('jam_per_minggu')->default(2); // Jam pelajaran per minggu
            $table->enum('tingkat', ['10', '11', '12'])->nullable(); // Untuk kelas berapa (bisa null jika untuk semua tingkat)
            $table->boolean('status_aktif')->default(true); // Apakah mata pelajaran masih aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_pelajarans');
    }
};
