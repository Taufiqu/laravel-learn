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
        User::create([
            'name' => 'Admin Utama',
            'email' => 'adminutama@sekolah.com',
            'password' => Hash::make('12345678'), // Ganti dengan password default yang aman
            'role' => 'admin'
        ]);
    }
}
