<x-guest-layout>
    <!-- Header Section -->
    <div class="mb-6 text-center">
        @if(isset($role) && $role)
            @if($role == 'guru')
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full mb-4">
                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-green-800 dark:text-green-300">Daftar Guru</h2>
                <p class="text-green-600 dark:text-green-400 text-sm mt-2">Buat akun guru untuk mengakses sistem akademik</p>
            @elseif($role == 'siswa')
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full mb-4">
                    <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-blue-800 dark:text-blue-300">Daftar Siswa</h2>
                <p class="text-blue-600 dark:text-blue-400 text-sm mt-2">Buat akun siswa untuk mengakses sistem</p>
            @endif
        @else
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Registrasi</h2>
            <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">Buat akun baru untuk sistem akademik</p>
        @endif
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Role Selection (Jika tidak ada role yang dipilih dari welcome page) -->
        @if(!isset($role) || !$role)
            <div class="mb-4">
                <x-input-label for="role" :value="__('Pilih Role')" />
                <select id="role" name="role" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                    <option value="">Pilih Role...</option>
                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>
        @else
            <!-- Hidden Role Field -->
            <input type="hidden" name="role" value="{{ $role }}">
            <div class="mb-4 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-medium">Role:</span> 
                    @if($role == 'guru') Guru  
                    @elseif($role == 'siswa') Siswa
                    @else {{ ucfirst($role) }}
                    @endif
                </p>
            </div>
        @endif

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="contoh@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" 
                            placeholder="Minimal 8 karakter" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" 
                            placeholder="Ulangi password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login', ['role' => $role ?? null]) }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Navigation Links -->
    @if(isset($role) && $role)
        <div class="mt-6 text-center text-sm">
            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('register') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 text-sm">
                    ← Pilih role yang berbeda
                </a>
            </div>
        </div>
    @endif
</x-guest-layout>
