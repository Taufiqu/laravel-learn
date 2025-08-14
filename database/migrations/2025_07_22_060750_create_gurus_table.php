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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique(); // Nomor Induk Pegawai
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']); // L = Laki-laki, P = Perempuan
            $table->text('alamat');
            $table->string('telepon')->nullable();
            $table->string('email')->unique()->nullable();
            $table->enum('status_kepegawaian', ['PNS', 'GTT', 'GTY', 'Honorer'])->default('GTT');
            $table->string('mata_pelajaran')->nullable(); // Bisa jadi akan dipindah ke tabel terpisah nanti
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('pendidikan_terakhir')->nullable(); // S1, S2, dll
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
