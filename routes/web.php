<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController; 
use App\Http\Controllers\KelasController;
use App\Http\Controllers\GuruController; 
use App\Http\Controllers\MataPelajaranController; 
use App\Http\Controllers\Auth\AuthenticatedSessionController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda mendaftarkan semua rute untuk aplikasi web Anda.
|
*/

// 1. Rute Publik (Smart redirect berdasarkan status login)
Route::get('/', function () {
    if (Auth::check()) {
        // Jika sudah login, redirect ke dashboard sesuai role
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }
    // Jika belum login, tampilkan landing page
    return view('welcome');
});

// 2. Rute untuk Guest (User belum login) - MIDDLEWARE GROUP
Route::middleware('guest')->group(function () {
    
    // Rute Login dengan Parameter Role (untuk membedakan jenis login)
    Route::get('/login/{role?}', function($role = null) {
        // Jika tidak ada role, tampilkan halaman pilihan role login
        if (!$role) {
            return view('auth.login-select');
        }
        return view('auth.login', compact('role'));
    })->name('login');
    
    // Rute POST Login dengan Parameter Role - dengan validasi role
    Route::post('/login/{role?}', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');
    
    // Rute Register dengan Pre-filled Role Selection
    Route::get('/register/{role?}', function($role = null) {
        return view('auth.register', compact('role'));
    })->name('register');
    
    // Rute POST Register dengan role validation
    Route::post('/register/{role?}', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])
        ->name('register.store');
    
});

// 3. Rute untuk Semua Pengguna yang Terautentikasi (Siswa & Admin)
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard default (yang akan diakses siswa setelah login)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rute untuk mengelola profil pengguna sendiri
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// 4. Rute KHUSUS UNTUK ADMIN (Dilindungi middleware 'auth' dan 'role:admin')
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Rute Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Rute Spesifik untuk Siswa (Harus didefinisikan SEBELUM rute resource)
    Route::get('/siswa/trash', [SiswaController::class, 'trash'])->name('siswa.trash');
    Route::get('/siswa/{id}/restore', [SiswaController::class, 'restore'])->name('siswa.restore');
    Route::delete('/siswa/{id}/force-delete', [SiswaController::class, 'forceDelete'])->name('siswa.forceDelete');

    // Rute Resource Siswa (otomatis membuat index, create, store, show, edit, update, destroy)
    Route::resource('siswa', SiswaController::class);

    // Rute Resource Kelas (otomatis membuat index, create, store, show, edit, update, destroy)
    Route::resource('kelas', KelasController::class);

    // Rute Resource Guru (otomatis membuat index, create, store, show, edit, update, destroy)
    Route::resource('guru', GuruController::class);

    // Rute Resource Mata Pelajaran (otomatis membuat index, create, store, show, edit, update, destroy)
    Route::resource('mata-pelajaran', MataPelajaranController::class);
    
    // Rute spesifik untuk toggle status mata pelajaran
    Route::patch('/mata-pelajaran/{mata_pelajaran}/toggle-status', [MataPelajaranController::class, 'toggleStatus'])
         ->name('mata-pelajaran.toggle-status');

});


// 4. Rute Autentikasi (login, register, dll.) dari Laravel Breeze
require __DIR__.'/auth.php';