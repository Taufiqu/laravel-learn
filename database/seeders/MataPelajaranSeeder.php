<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataPelajaran;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mataPelajarans = [
            // Mata Pelajaran Wajib Kelas 10
            ['nama_mata_pelajaran' => 'Matematika', 'kode_mata_pelajaran' => 'MAT', 'kategori' => 'Wajib', 'tingkat' => '10', 'jam_per_minggu' => 4],
            ['nama_mata_pelajaran' => 'Bahasa Indonesia', 'kode_mata_pelajaran' => 'BIN', 'kategori' => 'Wajib', 'tingkat' => '10', 'jam_per_minggu' => 4],
            ['nama_mata_pelajaran' => 'Bahasa Inggris', 'kode_mata_pelajaran' => 'BIG', 'kategori' => 'Wajib', 'tingkat' => '10', 'jam_per_minggu' => 3],
            ['nama_mata_pelajaran' => 'Pendidikan Pancasila', 'kode_mata_pelajaran' => 'PKN', 'kategori' => 'Wajib', 'tingkat' => '10', 'jam_per_minggu' => 2],
            ['nama_mata_pelajaran' => 'Sejarah', 'kode_mata_pelajaran' => 'SEJ', 'kategori' => 'Wajib', 'tingkat' => '10', 'jam_per_minggu' => 2],
            ['nama_mata_pelajaran' => 'Fisika', 'kode_mata_pelajaran' => 'FIS', 'kategori' => 'Wajib', 'tingkat' => '10', 'jam_per_minggu' => 3],
            ['nama_mata_pelajaran' => 'Kimia', 'kode_mata_pelajaran' => 'KIM', 'kategori' => 'Wajib', 'tingkat' => '10', 'jam_per_minggu' => 3],
            ['nama_mata_pelajaran' => 'Biologi', 'kode_mata_pelajaran' => 'BIO', 'kategori' => 'Wajib', 'tingkat' => '10', 'jam_per_minggu' => 3],
            ['nama_mata_pelajaran' => 'Geografi', 'kode_mata_pelajaran' => 'GEO', 'kategori' => 'Wajib', 'tingkat' => '10', 'jam_per_minggu' => 2],
            ['nama_mata_pelajaran' => 'Ekonomi', 'kode_mata_pelajaran' => 'EKO', 'kategori' => 'Wajib', 'tingkat' => '10', 'jam_per_minggu' => 2],
            ['nama_mata_pelajaran' => 'Sosiologi', 'kode_mata_pelajaran' => 'SOS', 'kategori' => 'Wajib', 'tingkat' => '10', 'jam_per_minggu' => 2],
            ['nama_mata_pelajaran' => 'Seni Budaya', 'kode_mata_pelajaran' => 'SBD', 'kategori' => 'Wajib', 'tingkat' => '10', 'jam_per_minggu' => 2],
            ['nama_mata_pelajaran' => 'Pendidikan Jasmani', 'kode_mata_pelajaran' => 'PJO', 'kategori' => 'Wajib', 'tingkat' => '10', 'jam_per_minggu' => 2],
            
            // Mata Pelajaran Kelas 11
            ['nama_mata_pelajaran' => 'Matematika Lanjut', 'kode_mata_pelajaran' => 'MATL', 'kategori' => 'Wajib', 'tingkat' => '11', 'jam_per_minggu' => 4],
            ['nama_mata_pelajaran' => 'Bahasa Indonesia Lanjut', 'kode_mata_pelajaran' => 'BINL', 'kategori' => 'Wajib', 'tingkat' => '11', 'jam_per_minggu' => 4],
            ['nama_mata_pelajaran' => 'Bahasa Inggris Lanjut', 'kode_mata_pelajaran' => 'BIGL', 'kategori' => 'Wajib', 'tingkat' => '11', 'jam_per_minggu' => 3],
            
            // Mata Pelajaran Kelas 12
            ['nama_mata_pelajaran' => 'Matematika Tingkat Lanjut', 'kode_mata_pelajaran' => 'MATTL', 'kategori' => 'Wajib', 'tingkat' => '12', 'jam_per_minggu' => 4],
            ['nama_mata_pelajaran' => 'Bahasa Indonesia Tingkat Lanjut', 'kode_mata_pelajaran' => 'BINTL', 'kategori' => 'Wajib', 'tingkat' => '12', 'jam_per_minggu' => 4],
            
            // Mata Pelajaran Pilihan
            ['nama_mata_pelajaran' => 'Informatika', 'kode_mata_pelajaran' => 'INF', 'kategori' => 'Pilihan', 'tingkat' => null, 'jam_per_minggu' => 2],
            ['nama_mata_pelajaran' => 'Bahasa Jerman', 'kode_mata_pelajaran' => 'BJE', 'kategori' => 'Pilihan', 'tingkat' => null, 'jam_per_minggu' => 2],
            ['nama_mata_pelajaran' => 'Bahasa Mandarin', 'kode_mata_pelajaran' => 'BMA', 'kategori' => 'Pilihan', 'tingkat' => null, 'jam_per_minggu' => 2],
            
            // Muatan Lokal
            ['nama_mata_pelajaran' => 'Bahasa Daerah', 'kode_mata_pelajaran' => 'BDA', 'kategori' => 'Muatan Lokal', 'tingkat' => null, 'jam_per_minggu' => 2],
            ['nama_mata_pelajaran' => 'Kewirausahaan', 'kode_mata_pelajaran' => 'KWU', 'kategori' => 'Muatan Lokal', 'tingkat' => null, 'jam_per_minggu' => 2],
        ];

        foreach ($mataPelajarans as $mapel) {
            MataPelajaran::create([
                'nama_mata_pelajaran' => $mapel['nama_mata_pelajaran'],
                'kode_mata_pelajaran' => $mapel['kode_mata_pelajaran'],
                'deskripsi' => "Mata pelajaran {$mapel['nama_mata_pelajaran']} dengan kategori {$mapel['kategori']}",
                'kategori' => $mapel['kategori'],
                'jam_per_minggu' => $mapel['jam_per_minggu'],
                'tingkat' => $mapel['tingkat'],
                'status_aktif' => true,
            ]);
        }
    }
}
