<?php

// database/seeders/AdminUserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // <-- Jangan lupa import
use Illuminate\Support\Facades\Hash; // <-- Jangan lupa import

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada untuk menghindari duplikasi
        if (!User::where('email', 'admin@sekolah.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@sekolah.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }

        // Admin kedua untuk backup/testing
        if (!User::where('email', 'admin2@sekolah.com')->exists()) {
            User::create([
                'name' => 'Admin Backup',
                'email' => 'admin2@sekolah.com', 
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }

        // Super Admin
        if (!User::where('email', 'superadmin@sekolah.com')->exists()) {
            User::create([
                'name' => 'Super Administrator',
                'email' => 'superadmin@sekolah.com',
                'password' => Hash::make('super123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }

        // User Guru untuk testing
        if (!User::where('email', 'guru@sekolah.com')->exists()) {
            User::create([
                'name' => 'Guru Testing',
                'email' => 'guru@sekolah.com',
                'password' => Hash::make('guru1234'),
                'role' => 'guru',
                'email_verified_at' => now(),
            ]);
        }

        // User Siswa untuk testing
        if (!User::where('email', 'siswa@sekolah.com')->exists()) {
            User::create([
                'name' => 'Siswa Testing',
                'email' => 'siswa@sekolah.com',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
                'email_verified_at' => now(),
            ]);
        }

        echo "✅ Admin users berhasil dibuat:\n";
        echo "   📧 admin@sekolah.com (password: admin123)\n";
        echo "   📧 admin2@sekolah.com (password: admin123)\n";
        echo "   📧 superadmin@sekolah.com (password: super123)\n";
        echo "   📧 guru@sekolah.com (password: guru123)\n";
        echo "   📧 siswa@sekolah.com (password: siswa123)\n\n";
    }
}
