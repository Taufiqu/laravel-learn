<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gurus = [
            [
                'nip' => '123456789012345001',
                'nama' => 'Dr. Siti Aminah, S.Pd., M.Pd.',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Pendidikan No. 123, Jakarta',
                'telepon' => '081234567001',
                'email' => 'siti.aminah@sekolah.com',
                'status_kepegawaian' => 'PNS',
                'mata_pelajaran' => 'Matematika',
                'tanggal_lahir' => '1985-05-15',
                'tempat_lahir' => 'Jakarta',
                'pendidikan_terakhir' => 'S2',
            ],
            [
                'nip' => '123456789012345002',
                'nama' => 'Ahmad Wijaya, S.Pd.',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Guru No. 456, Jakarta',
                'telepon' => '081234567002',
                'email' => 'ahmad.wijaya@sekolah.com',
                'status_kepegawaian' => 'PNS',
                'mata_pelajaran' => 'Bahasa Indonesia',
                'tanggal_lahir' => '1980-03-22',
                'tempat_lahir' => 'Bandung',
                'pendidikan_terakhir' => 'S1',
            ],
            [
                'nip' => '123456789012345003',
                'nama' => 'Maria Theresa, S.Pd.',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Cendekia No. 789, Jakarta',
                'telepon' => '081234567003',
                'email' => 'maria.theresa@sekolah.com',
                'status_kepegawaian' => 'GTT',
                'mata_pelajaran' => 'Bahasa Inggris',
                'tanggal_lahir' => '1988-12-10',
                'tempat_lahir' => 'Surabaya',
                'pendidikan_terakhir' => 'S1',
            ],
            [
                'nip' => '123456789012345004',
                'nama' => 'Prof. Dr. Budi Santoso, M.Si.',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Ilmu No. 101, Jakarta',
                'telepon' => '081234567004',
                'email' => 'budi.santoso@sekolah.com',
                'status_kepegawaian' => 'PNS',
                'mata_pelajaran' => 'Fisika',
                'tanggal_lahir' => '1975-08-30',
                'tempat_lahir' => 'Yogyakarta',
                'pendidikan_terakhir' => 'S3',
            ],
            [
                'nip' => '123456789012345005',
                'nama' => 'Dewi Sartika, S.Pd., M.Pd.',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Kartini No. 202, Jakarta',
                'telepon' => '081234567005',
                'email' => 'dewi.sartika@sekolah.com',
                'status_kepegawaian' => 'PNS',
                'mata_pelajaran' => 'Kimia',
                'tanggal_lahir' => '1983-11-18',
                'tempat_lahir' => 'Medan',
                'pendidikan_terakhir' => 'S2',
            ],
            [
                'nip' => '123456789012345006',
                'nama' => 'Rahmat Hidayat, S.Pd.',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Diponegoro No. 303, Jakarta',
                'telepon' => '081234567006',
                'email' => 'rahmat.hidayat@sekolah.com',
                'status_kepegawaian' => 'GTT',
                'mata_pelajaran' => 'Biologi',
                'tanggal_lahir' => '1990-06-25',
                'tempat_lahir' => 'Semarang',
                'pendidikan_terakhir' => 'S1',
            ],
            [
                'nip' => '123456789012345007',
                'nama' => 'Fatimah Az-Zahra, S.Pd.',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Pahlawan No. 404, Jakarta',
                'telepon' => '081234567007',
                'email' => 'fatimah.azzahra@sekolah.com',
                'status_kepegawaian' => 'GTY',
                'mata_pelajaran' => 'Sejarah',
                'tanggal_lahir' => '1987-09-14',
                'tempat_lahir' => 'Makassar',
                'pendidikan_terakhir' => 'S1',
            ],
            [
                'nip' => '123456789012345008',
                'nama' => 'Indra Gunawan, S.Pd.',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Merdeka No. 505, Jakarta',
                'telepon' => '081234567008',
                'email' => 'indra.gunawan@sekolah.com',
                'status_kepegawaian' => 'Honorer',
                'mata_pelajaran' => 'Pendidikan Jasmani',
                'tanggal_lahir' => '1992-04-07',
                'tempat_lahir' => 'Palembang',
                'pendidikan_terakhir' => 'S1',
            ],
        ];

        foreach ($gurus as $guru) {
            Guru::create($guru);
        }
    }
}
