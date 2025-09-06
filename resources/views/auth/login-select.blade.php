<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Pilih Role Login</h2>
                <p class="mt-2 text-sm text-gray-600">Silakan pilih role sesuai dengan akses Anda</p>
            </div>

            <!-- Role Selection Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Admin Login -->
                <a href="{{ route('login', ['role' => 'admin']) }}" 
                   class="group relative bg-white border-2 border-red-200 rounded-xl p-6 hover:border-red-300 hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-red-200 transition-colors">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-red-800 mb-2">Administrator</h3>
                        <p class="text-red-600 text-sm mb-4">Akses penuh untuk mengelola seluruh sistem akademik</p>
                        <div class="bg-red-600 group-hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Login Admin
                        </div>
                    </div>
                </a>

                <!-- Guru Login -->
                <a href="{{ route('login', ['role' => 'guru']) }}" 
                   class="group relative bg-white border-2 border-green-200 rounded-xl p-6 hover:border-green-300 hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-green-800 mb-2">Guru</h3>
                        <p class="text-green-600 text-sm mb-4">Akses data siswa dan kelas yang diampu</p>
                        <div class="bg-green-600 group-hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Login Guru
                        </div>
                    </div>
                </a>

                <!-- Siswa Login -->
                <a href="{{ route('login', ['role' => 'siswa']) }}" 
                   class="group relative bg-white border-2 border-blue-200 rounded-xl p-6 hover:border-blue-300 hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-blue-800 mb-2">Siswa</h3>
                        <p class="text-blue-600 text-sm mb-4">Akses profil pribadi dan informasi akademik</p>
                        <div class="bg-blue-600 group-hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Login Siswa
                        </div>
                    </div>
                </a>
            </div>

            <!-- Footer Links -->
            <div class="text-center space-y-3 pt-6 border-t">
                <p class="text-sm text-gray-600">
                    Belum memiliki akun?
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Daftar akun baru
                    </a>
                </p>
                <p class="text-xs text-gray-500">
                    <a href="{{ url('/') }}" class="hover:text-gray-700 underline">
                        ← Kembali ke beranda
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
