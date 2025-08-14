<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas; // <-- Jangan lupa import

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_kelas = [
            ['nama_kelas' => 'Kelas A', 'tingkat' => 10, 'nama_walikelas' => 'Budi Santoso'],
            ['nama_kelas' => 'Kelas B', 'tingkat' => 10, 'nama_walikelas' => 'Siti Aminah'],
            ['nama_kelas' => 'Kelas C', 'tingkat' => 11, 'nama_walikelas' => 'Eko Prasetyo'],
            ['nama_kelas' => 'Kelas D', 'tingkat' => 11, 'nama_walikelas' => 'Dewi Lestari'],
        ];

        foreach ($data_kelas as $kelas) {
            Kelas::create($kelas);
        }
    }
}